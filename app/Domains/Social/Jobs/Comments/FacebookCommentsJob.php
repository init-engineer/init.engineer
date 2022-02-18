<?php

namespace App\Domains\Social\Jobs\Comments;

use App\Domains\Social\Models\Platform;
use App\Domains\Social\Models\PlatformCards;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
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
     * @var PlatformCards
     */
    protected $cards;

    /**
     * @var Platform
     */
    protected $platform;

    /**
     * Create a new job instance.
     *
     * @param PlatformCards $cards
     * @param Platform $platform
     *
     * @return void
     */
    public function __construct(PlatformCards $cards, Platform $platform)
    {
        $this->cards = $cards;
        $this->platform = $platform;
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
                ->performedOn($this->cards)
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

        $comments = $this->getComments(
            $this->platform->config['graph_version'],
            $this->platform->config['user_id'],
            $this->cards->platform_string_id,
            $accessToken,
        );



        // $url = sprintf(
        //     '/%s?fields=comments{id,message,created_time,comments{id,message,from,created_time}}',
        //     $mediaCards->social_card_id
        // );
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
