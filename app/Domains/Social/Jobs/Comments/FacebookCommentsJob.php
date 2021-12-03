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

        // $url = sprintf(
        //     '/%s?fields=comments{id,message,created_time,comments{id,message,from,created_time}}',
        //     $mediaCards->social_card_id
        // );
    }
}
