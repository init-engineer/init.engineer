<?php

namespace App\Domains\Social\Jobs\Comments;

use App\Domains\Social\Models\Platform;
use App\Domains\Social\Models\PlatformCards;
use App\Domains\Social\Services\CommentsService;
use Illuminate\Bus\Queueable;
use Illuminate\Container\Container;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

/**
 * Class FacebookCommentJob.
 */
class FacebookCommentJob implements ShouldQueue
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
     * @var string
     */
    protected $graphVersion;

    /**
     * @var string
     */
    protected $userId;

    /**
     * @var string
     */
    protected $postId;

    /**
     * @var string
     */
    protected $accessToken;

    /**
     * @var string
     */
    protected $after = null;

    /**
     * Create a new job instance.
     *
     * @param Platform $platform
     * @param PlatformCards $platformCards
     * @param string $graphVersion
     * @param string $userId
     * @param string $postId
     * @param string $accessToken
     * @param string $after = null
     *
     * @return void
     */
    public function __construct($platform, $platformCards, string $graphVersion, string $userId, string $postId, string $accessToken, string $after = null)
    {
        $this->platform = $platform;
        $this->platformCards = $platformCards;
        $this->graphVersion = $graphVersion;
        $this->userId = $userId;
        $this->postId = $postId;
        $this->accessToken = $accessToken;
        $this->after = $after;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        /**
         * 建構 CommentsService 物件
         */
        $container = Container::getInstance();
        $commentService = $container->make(CommentsService::class);

        /**
         * 整理 $url 呼叫的 API URL
         */
        $url = sprintf(
            'https://graph.facebook.com/%s/%s_%s/comments?access_token=%s&limit=25&fields=%s',
            $this->graphVersion,
            $this->userId,
            $this->postId,
            $this->accessToken,
            'created_time,message,id,from{id,name},comments{created_time,message,id,from{id,name}}',
        );

        if ($this->after !== null) {
            $url = sprintf(
                '%s&after=%s',
                $url,
                $this->after,
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
        if (isset($responseBody['data'])) {
            /**
             * 判斷是否有更多留言，如果有的話就排下個 Job
             */
            if (isset($responseBody['paging']['next'])) {
                $cursorsAfter = isset($responseBody['paging']['cursors']) ? $responseBody['paging']['cursors']['after'] : null;
                dispatch(new FacebookCommentJob($this->platform, $this->platformCards, $this->graphVersion, $this->userId, $this->postId, $this->accessToken, $cursorsAfter))->onQueue('lowest');
            }

            /**
             * 根據 Comments 的資訊列來逐一檢查是否新增或更新的資料
             */
            foreach ($responseBody['data'] as $comment) {
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
                        'created_at' => $comment['created_time'],
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
                                'created_at' => $reply['created_time'],
                            ));
                        }
                    }
                }
            }
        }

        return;
    }
}
