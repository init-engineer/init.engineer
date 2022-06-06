<?php

namespace App\Domains\Social\Jobs\Publish;

use App\Domains\Social\Models\Cards;
use App\Domains\Social\Models\Platform;
use App\Domains\Social\Services\Content\ContentFluent;
use App\Domains\Social\Services\PlatformCardService;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use Illuminate\Bus\Queueable;
use Illuminate\Container\Container;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

/**
 * Class TumblrPublishJob.
 *
 * @implements ShouldQueue
 */
class TumblrPublishJob implements ShouldQueue
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
     * @return void
     */
    public function handle()
    {
        /**
         * 判斷 Blog Name、Consumer Key、Consumer Secret、Token、Token Secret 是否為空
         */
        if (
            !isset($this->platform->config['user_id']) ||
            !isset($this->platform->config['consumer_app_key']) ||
            !isset($this->platform->config['consumer_app_secret']) ||
            !isset($this->platform->config['access_token']) ||
            !isset($this->platform->config['access_token_secret'])
        ) {
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
         * 透過 Guzzle 的 HandlerStack 來建立堆疊
         */
        $stack = HandlerStack::create();

        /**
         * 透過 Guzzle 的 OAuth1 來建立請求
         */
        $middleware = new Oauth1([
            'consumer_key'    => $this->platform->config['consumer_app_key'],
            'consumer_secret' => $this->platform->config['consumer_app_secret'],
            'token'           => $this->platform->config['access_token'],
            'token_secret'    => $this->platform->config['access_token_secret'],
        ]);
        $stack->push($middleware);

        /**
         * 整理文章通知的內容
         */
        $caption = $contentFluent->reset()
            ->header($this->cards->id)
            ->hr()
            ->body($this->cards->content)
            ->hr()
            ->footer(sprintf('💖 %s 官方 Discord 歡迎在這找到你的同溫層！', appName()))
            ->footer('👉 https://discord.gg/tPhnrs2')
            ->hr()
            ->footer('💖 全平台留言、文章詳細內容')
            ->footer('👉 ' . route('frontend.social.cards.show', ['id' => $this->cards->id]))
            ->build('html');

        /**
         * 整理 API Uri
         */
        $name = $this->platform->config['user_id'];
        $url = "/v2/blog/$name.tumblr.com/post";

        /**
         * 判斷文章是否已經發表出去
         */
        if ($platformCard = $platformCardService->findPlatformCardById($this->platform->id, $this->cards->id)) {
            /**
             * 在這個 Tumblr 已經將文章發表出去，並且記錄起來了
             */
            activity('social cards - tumblr post published')
                ->performedOn($this->cards)
                ->log(json_encode($platformCard));

            return;
        }

        /**
         * 開始執行通知
         */
        $response = Http::withMiddleware($middleware)
            ->withOptions([
                'base_uri' => 'https://api.tumblr.com',
                'handler' => $stack,
                'auth' => 'oauth',
            ])->post($url, [
                'source' => $this->cards->getPicture(),
                'type' => 'photo',
                'caption' => $caption,
            ]);

        /**
         * 紀錄 response 資訊
         */
        activity('social cards - tumblr publish')
            ->performedOn($this->cards)
            ->log($response->body());

        /**
         * 建立 PlatformCards 紀錄
         */
        $platformCard = $platformCardService->store([
            'platform_type' => Platform::TYPE_TUMBLR,
            'platform_id' => $this->platform->id,
            'platform_string_id' => $response->json()['response']['id_string'],
            'platform_url' => sprintf(
                'https://%s.tumblr.com/post/%s',
                $this->platform->config['pages_name'],
                $response->json()['response']['id_string'],
            ),
            'card_id' => $this->cards->id,
        ]);

        /**
         * 紀錄 PlatformCards
         */
        activity('social cards - telegram platform card')
            ->performedOn($platformCard)
            ->log(json_encode($platformCard));

        return;
    }
}
