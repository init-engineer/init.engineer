<?php

namespace App\Domains\Social\Jobs\Publish;

use App\Domains\Social\Jobs\Push\FacebookPushCommentJob;
use App\Domains\Social\Models\Cards;
use App\Domains\Social\Models\Platform;
use App\Domains\Social\Services\Content\ContentFluent;
use App\Domains\Social\Services\PlatformCardService;
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
 * Class FacebookPublishJob.
 */
class FacebookPublishJob implements ShouldQueue
{
    use Dispatchable,
        InteractsWithQueue,
        Queueable,
        SerializesModels;

    /**
     * @var Cards
     */
    protected $cards;

    /**
     * @var Platform
     */
    protected $platform;

    /**
     * Create a new job instance.
     *
     * @param Cards $cards
     * @param Platform $platform
     *
     * @return void
     */
    public function __construct(Cards $cards, Platform $platform)
    {
        $this->cards = $cards;
        $this->platform = $platform;
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
            activity('social cards - publish error')
                ->performedOn($this->cards)
                ->log(json_encode($this->platform));

            return;
        }

        /**
         * 建立 Content 內容編排器
         */
        $container = Container::getInstance();
        $contentFluent = $container->make(ContentFluent::class);
        $platformCardService = $container->make(PlatformCardService::class);

        /**
         * 整理文章通知的內容
         */
        $message = $contentFluent->reset()
            ->header($this->cards->id)
            ->hr()
            ->body($this->cards->content)
            ->build();

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
         * 判斷文章是否已經發表出去
         */
        if ($platformCard = $platformCardService->findPlatformCardById($this->platform->id, $this->cards->id)) {
            /**
             * 在這個 Facebook 已經將文章發表出去，並且記錄起來了
             */
            activity('social cards - facebook post published')
                ->performedOn($this->cards)
                ->log(json_encode($platformCard));

            return;
        }

        /**
         * 開始執行通知
         */
        $url = sprintf(
            "https://graph.facebook.com/%s/photos?",
            $userId,
        );
        $response = Http::post($url, [
            'url' => $this->cards->getPicture(),
            'access_token' => $accessToken,
            'message' => $message,
        ]);

        /**
         * 紀錄 response 資訊
         */
        activity('social cards - facebook publish')
            ->performedOn($this->cards)
            ->log($response->body());

        /**
         * 建立 PlatformCards 紀錄
         */
        $platform_string_id = mb_split("_", $response->json()['post_id'])[1];
        $platformCard = $platformCardService->store([
            'platform_type' => Platform::TYPE_FACEBOOK,
            'platform_id' => $this->platform->id,
            'platform_string_id' => $platform_string_id,
            'platform_url' => sprintf(
                'https://www.facebook.com/%s/photos/%s',
                $this->platform->config['pages_name'],
                $platform_string_id,
            ),
            'card_id' => $this->cards->id,
        ]);

        /**
         * 紀錄 PlatformCards
         */
        activity('social cards - facebook platform card')
            ->performedOn($platformCard)
            ->log(json_encode($platformCard));

        /**
         * 建立 Discord 宣傳內容
         */
        $message = $contentFluent->reset()
            ->footer(sprintf('💖 %s 官方 Discord 歡迎在這找到你的同溫層！', appName()))
            ->footer('👉 https://discord.gg/tPhnrs2')
            ->build();

        /**
         * 對社群文章執行 Discord 宣傳留言
         */
        dispatch(new FacebookPushCommentJob($this->platform, $platformCard, $message))->onQueue('medium');

        /**
         * 建立文章宣傳內容
         */
        $message = $contentFluent->reset()
            ->footer('💖 全平台留言、文章詳細內容')
            ->footer('👉 ' . route('frontend.social.cards.show', ['id' => $this->cards->id]))
            ->build();

        /**
         * 對社群文章執行文章宣傳留言
         */
        dispatch(new FacebookPushCommentJob($this->platform, $platformCard, $message))->onQueue('medium');

        return;
    }
}
