<?php

namespace App\Domains\Social\Jobs\Publish;

use App\Domains\Social\Models\Cards;
use App\Domains\Social\Models\Platform;
use App\Domains\Social\Services\PlatformCardService;
use Illuminate\Bus\Queueable;
use Illuminate\Container\Container;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

/**
 * Class DiscordPublishJob.
 */
class DiscordPublishJob implements ShouldQueue
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
     * 發表到 Discord
     * 字數限制 2,000，所以不需要留言補充連結宣傳，只需要對內文下 Limit 即可。
     *
     * @return void
     */
    public function handle()
    {
        /**
         * 判斷 Webhook URL 是否為空
         */
        if (!isset($this->platform->config['webhook'])) {
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
        $platformCardService = $container->make(PlatformCardService::class);

        /**
         * 開始執行通知
         */
        $url = $this->platform->config['webhook'];
        $response = Http::post($url . '?wait=1', array(
            'embeds' => array(
                array(
                    'title' => '#' . appName() . base_convert($this->cards->id, 10, 36),
                    'url' => route('frontend.social.cards.show', $this->cards->id),
                    'description' => Str::limit($this->cards->content, 1800, ' ...'),
                    'color' => 15258703,
                    'image' => array(
                        'url' => $this->cards->getPicture(),
                    ),
                    'timestamp' => $this->cards->created_at,
                ),
            ),
        ));

        /**
         * 紀錄 response 資訊
         */
        activity('social cards - discord publish')
            ->performedOn($this->cards)
            ->log($response->body());

        /**
         * 建立 PlatformCards 紀錄
         */
        $platformCard = $platformCardService->store(array(
            'platform_type' => Platform::TYPE_TWITTER,
            'platform_id' => $this->platform->id,
            'platform_string_id' => $response->json()['id'],
            'card_id' => $this->cards->id,
        ));

        /**
         * 紀錄 PlatformCards
         */
        activity('social cards - discord platform card')
            ->performedOn($platformCard)
            ->log(json_encode($platformCard));

        return;
    }
}
