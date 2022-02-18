<?php

namespace App\Console\Commands\Social;

use App\Domains\Social\Models\Comments;
use App\Domains\Social\Models\Platform;
use App\Domains\Social\Services\CommentsService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

/**
 * Class PlatformCommentsUpdate.
 */
class PlatformCommentsUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'social:platform-comments-update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '檢查所有社群平台的留言資訊。';

    /**
     * @var Platform
     */
    protected $platform;

    /**
     * @var CommentsService
     */
    protected $commentsService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CommentsService $commentsService)
    {
        parent::__construct();

        $this->commentsService = $commentsService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->platform = Platform::find(2);

        /**
         * 運作邏輯
         *
         * 1. 最新發表的文章需要階段性更新留言，每 5 分鐘更新 1 次，每個小時更新頻率 12 次。
         * 2. 前 20 篇文章需要階段性更新留言，每 20 分鐘更新 1 次，每個小時更新頻率 60 次。
         * 3. 循環更新所有文章的留言，每 1 分鐘搜尋 1 篇文章，每個小時更新頻率 60 次。
         */

        /**
         * 判斷 Page ID、Access Token 是否為空
         */
        if (
            !isset($this->platform->config['user_id']) ||
            !isset($this->platform->config['access_token'])
        ) {
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

        $comments = $this->getComments(
            $this->platform->config['graph_version'],
            $this->platform->config['user_id'],
            '4822678657779110',
            $accessToken,
        );

        foreach ($comments as $comment) {
            $this->commentsService->store(array(
                'card_id' => $data['card_id'],
                'platform_id' => $data['platform_id'] ?? null,
                'platform_card_id' => $data['platform_card_id'] ?? null,
                'comment_id' => $data['comment_id'] ?? null,
                'user_name' => $data['user_name'] ?? '匿名',
                'user_id' => $data['user_id'] ?? null,
                'user_avatar' => $data['user_avatar'] ?? null,
                'content' => $data['comments'] ?? $data['content'] ?? null,
                'reply' => $data['reply'] ?? null,
            ));
        }

        dd($comments);

        return Command::SUCCESS;
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
