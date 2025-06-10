<?php

namespace App\Domains\Social\Jobs\Push;

use App\Domains\Social\Models\Platform;
use App\Domains\Social\Models\PlatformCards;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

/**
 * Class FacebookPushCommentJob.
 */
class FacebookPushCommentJob implements ShouldQueue
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
    protected $platformCard;

    /**
     * @var string
     */
    protected $message;

    /**
     * Create a new job instance.
     *
     * @param Platform $platform
     * @param PlatformCards $platformCard
     * @param string $message
     *
     * @return void
     */
    public function __construct(Platform $platform, PlatformCards $platformCard, string $message)
    {
        $this->platform = $platform;
        $this->platformCard = $platformCard;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * 發表到 Facebook
     * 文章內提及連結會影響觸及率，因此需要留言補充連結宣傳。
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
            activity('social cards - facebook push message error')
                ->performedOn($this->platformCard)
                ->log(json_encode($this->platform));

            return;
        }

        /**
         * 對社群文章執行留言
         */
        $url = sprintf('https://graph.facebook.com/%s_%s/comments', $this->platform->config['user_id'], $this->platformCard->platform_string_id);
        $response = Http::post($url, [
            'access_token' => $this->platform->config['access_token'],
            'message' => $this->message,
        ]);

        /**
         * 紀錄文章留言
         */
        activity('social cards - facebook push message')
            ->performedOn($this->platformCard)
            ->log($response->body());

        return;
    }
}
