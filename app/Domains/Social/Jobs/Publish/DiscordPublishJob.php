<?php

namespace App\Domains\Social\Jobs\Publish;

use App\Domains\Social\Models\Cards;
use App\Domains\Social\Models\Platform;
use App\Domains\Social\Services\PlatformCardService;
use Illuminate\Bus\Queueable;
use Illuminate\Container\Container;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

/**
 * Class DiscordPublishJob.
 *
 * @implements ShouldQueue
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
         * 判斷文章是否已經發表出去
         */
        if ($platformCard = $platformCardService->findPlatformCardById($this->platform->id, $this->cards->id)) {
            /**
             * 在這個 Discord 已經將文章發表出去，並且記錄起來了
             */
            activity('social cards - discord post published')
                ->performedOn($this->cards)
                ->log(json_encode($platformCard));

            return;
        }

        /**
         * 開始執行通知
         */
        $url = $this->platform->config['webhook'];
        $response = Http::post($url . '?wait=1', [
            'embeds' => [
                [
                    'title' => '#' . appName() . base_convert($this->cards->id, 10, 36),
                    'url' => route('frontend.social.cards.show', $this->cards->id),
                    'description' => Str::limit($this->cards->content, 1800, ' ...'),
                    'color' => 15258703,
                    'image' => [
                        'url' => $this->cards->getPicture(),
                    ],
                    'timestamp' => $this->cards->created_at,
                ],
            ],
        ]);

        /**
         * 紀錄 response 資訊
         */
        activity('social cards - discord publish')
            ->performedOn($this->cards)
            ->log($response->body());

        /**
         * 建立 PlatformCards 紀錄
         */
        $platformCard = $platformCardService->store([
            'platform_type' => Platform::TYPE_DISCORD,
            'platform_id' => $this->platform->id,
            'platform_string_id' => $response->json()['id'],
            'platform_url' => sprintf(
                'https://discord.com/channels/%s/%s/%s',
                $this->platform->config['discord_id'],
                $this->platform->config['channel_id'],
                $response->json()['id'],
            ),
            'card_id' => $this->cards->id,
        ]);

        /**
         * 紀錄 PlatformCards
         */
        activity('social cards - discord platform card')
            ->performedOn($platformCard)
            ->log(json_encode($platformCard));

        return;
    }
}
