<?php

namespace App\Domains\Social\Jobs\Comments;

use App\Domains\Social\Models\Platform;
use App\Domains\Social\Models\PlatformCards;
use App\Domains\Social\Services\CommentsService;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Container\Container;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

/**
 * Class FacebookCommentsJob.
 */
class FacebookCommentsJob implements ShouldQueue
{
    use Dispatchable,
        InteractsWithQueue,
        Queueable,
        SerializesModels;

    /**
     * @var Platform
     */
    protected $platform;

    /**
     * @var PlatformCards
     */
    protected $platformCards;

    /**
     * Create a new job instance.
     *
     * @param Platform $platform
     * @param PlatformCards $platformCards
     *
     * @return void
     */
    public function __construct(Platform $platform, PlatformCards $platformCards)
    {
        $this->platform = $platform;
        $this->platformCards = $platformCards;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        /**
         * 判斷 Page ID、Access Token 是否為空
         */
        if (!isset($this->platform->config['user_id']) ||
            !isset($this->platform->config['access_token'])) {
            /**
             * Config 有問題，無法處理
             */
            activity('social cards - comments error')
                ->performedOn($this->platformCards)
                ->log(json_encode($this->platform));

            return;
        }

        /**
         * 在執行通知之前，先看看 Cache 有沒有已經暫存的 access token
         * 如果有已經暫存的 access token，直接沿用原本的
         * 如果沒有或已經過期，那麼需要重新獲取新的
         * https://developers.facebook.com/docs/pages/access-tokens
         */
        $userId = $this->platform->config['user_id'];
        $key = sprintf("facebook_access_token_%s", $userId);
        $accessToken = Cache::get($key);
        if ($accessToken === null) {
            /**
             * access token 並不存在或已經過期，需要重新獲取新的
             */
            $url = sprintf(
                "https://graph.facebook.com/%s?fields=access_token&access_token=%s",
                $userId,
                $this->platform->config['access_token'],
            );
            $response = Http::get($url);
            $accessToken = $response->json()['access_token'];

            /**
             * 將新申請的 access token 存入 Cache
             */
            $expiresAt = Carbon::now()->addMinutes(60);
            Cache::put($key, $accessToken, $expiresAt);
        }

        /**
         * 換得整個 Comments 的資訊列
         */
        $comments = $this->getComments(
            $this->platform->config['graph_version'],
            $this->platform->config['user_id'],
            $this->platformCards->platform_string_id,
            $accessToken,
        );

        /**
         * 建構 CommentsService 物件
         */
        $container = Container::getInstance();
        $commentService = $container->make(CommentsService::class);

        /**
         * 根據 Comments 的資訊列來逐一檢查是否新增或更新的資料
         */
        foreach ($comments as $comment) {
            /**
             * 判斷 Comment 是否已經存在
             */
            if ($commentModel = $commentService->findCommentById($comment['id'])) {
                /**
                 * Comment 已經存在，檢查 message 是否有更新過，如果有更新過，就同步更新資料庫內的資料。
                 */
                if ($commentModel->content != $comment['message']) {
                    $commentModel->content = $comment['message'];
                    $commentModel->save();
                }
            } else {
                /**
                 * Comment 並不存在，直接寫入一筆新的資料。
                 */
                $commentService->store(array(
                    'card_id' => $this->platformCards->card_id,
                    'platform_id' => $this->platform->id,
                    'platform_card_id' => $this->platformCards->id,
                    'comment_id' => $comment['id'],
                    'content' => $comment['message'] ?? null,
                    'created_time' => $comment['created_time'],
                ));
            }

            /**
             * 判斷 Comment 是否有被 Reply
             */
            if (isset($comment['comments'])) {
                foreach ($comment['comments']['data'] as $reply) {
                    /**
                     * 判斷 Reply 是否已經存在
                     */
                    if ($replyModel = $commentService->findCommentById($reply['id'])) {
                        /**
                         * Reply 已經存在，檢查 message 是否有更新過，如果有更新過，就同步更新資料庫內的資料。
                         */
                        if ($replyModel->content != $reply['message']) {
                            $replyModel->content = $reply['message'];
                            $replyModel->save();
                        }
                    } else {
                        /**
                         * Reply 並不存在，直接寫入一筆新的資料。
                         */
                        $commentService->store(array(
                            'card_id' => $this->platformCards->card_id,
                            'platform_id' => $this->platform->id,
                            'platform_card_id' => $this->platformCards->id,
                            'comment_id' => $reply['id'],
                            'content' => $reply['message'] ?? null,
                            'reply' => $comment['id'],
                            'created_time' => $reply['created_time'],
                        ));
                    }
                }
            }
        }
    }

    /**
     * @param string $graphVersion
     * @param string $userId
     * @param string $postId
     * @param string $accessToken
     * @param string $after = null
     * @param array $beforeComments = array()
     *
     * @return array
     */
    private function getComments(string $graphVersion, string $userId, string $postId, string $accessToken, string $after = null, array $beforeComments = array()): array
    {
        /**
         * 整理 $url 呼叫的 API URL
         */
        $url = sprintf(
            'https://graph.facebook.com/%s/%s_%s/comments?access_token=%s&limit=25&fields=%s',
            $graphVersion,
            $userId,
            $postId,
            $accessToken,
            'created_time,message,id,from{id,name},comments{created_time,message,id,from{id,name}}',
        );

        if ($after !== null) {
            $url = sprintf(
                '%s&after=%s',
                $url,
                $after,
            );
        }

        /**
         * 獲得 Comments 資訊
         */
        $response = Http::get($url);
        $responseBody = $response->json();

        /**
         * 整理 Comments 並判斷是否繼續遞迴去獲取接續的 Comments
         */
        $afterComments = $responseBody['data'];
        $afterComments = array_merge($afterComments, $beforeComments);

        if (isset($responseBody['paging']['next'])) {
            return $this->getComments(
                $graphVersion,
                $userId,
                $postId,
                $accessToken,
                $responseBody['paging']['cursors']['after'],
                $afterComments,
            );
        }

        return $afterComments;
    }
}
