<?php

namespace App\Domains\Social\Jobs\Publish;

use App\Domains\Social\Models\Cards;
use App\Domains\Social\Models\Platform;
use App\Domains\Social\Services\Content\ContentFluent;
use App\Domains\Social\Services\PlatformCardService;
use Illuminate\Bus\Queueable;
use Illuminate\Container\Container;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
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
         * 開始執行通知
         */
        $userID = $this->platform->config['user_id'];
        $url = "https://graph.facebook.com/$userID/photos?";
        $response = Http::post($url, array(
            'url' => $this->cards->getPicture(),
            'access_token' => $this->platform->config['access_token'],
            'message' => $message,
        ));

        /**
         * 紀錄 response 資訊
         */
        activity('social cards - facebook publish')
            ->performedOn($this->cards)
            ->log($response->body());

        /**
         * 建立 PlatformCards 紀錄
         */
        $platformCard = $platformCardService->store(array(
            'platform_type' => Platform::TYPE_FACEBOOK,
            'platform_id' => $this->platform->id,
            'platform_string_id' => $response->json()['post_id'],
            'platform_url' => sprintf(
                'https://www.facebook.com/%s/photos/%s',
                $this->platform->config['pages_name'],
                $response->json()['post_id'],
            ),
            'card_id' => $this->cards->id,
        ));

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
        $url = sprintf('https://graph.facebook.com/%s/comments', $response->body()['post_id']);
        $response = Http::post($url, array(
            'access_token' => $this->platform->config['access_token'],
            'message' => $message,
        ));

        /**
         * 紀錄 Discord 宣傳留言
         */
        activity('social cards - facebook platform comments')
            ->performedOn($platformCard)
            ->log($response->body());

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
        $response = Http::post($url, array(
            'access_token' => $this->platform->config['access_token'],
            'message' => $message,
        ));

        /**
         * 紀錄文章宣傳留言
         */
        activity('social cards - facebook platform comments')
            ->performedOn($platformCard)
            ->log($response->body());

        return;
    }
}
