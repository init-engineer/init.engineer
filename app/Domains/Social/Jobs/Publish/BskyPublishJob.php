<?php

namespace App\Domains\Social\Jobs\Publish;

use App\Domains\Social\Models\Cards;
use App\Domains\Social\Models\Platform;
use App\Domains\Social\Services\Content\ContentFluent;
use App\Domains\Social\Services\PlatformCardService;
use Illuminate\Bus\Queueable;
use Illuminate\Container\Container;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

/**
 * Class BskyPublishJob.
 */
class BskyPublishJob implements ShouldQueue
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
     * 發表到 Bsky
     * 文章內提及連結會影響觸及率，因此需要留言補充連結宣傳。
     *
     * @return void
     */
    public function handle()
    {
        /**
         * 判斷 Page ID、Access Token 是否為空
         */
        if (!isset($this->platform->config['identifier']) ||
            !isset($this->platform->config['password'])) {
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
         * 整理文章通知的內容
         */
        $message = $contentFluent->reset()
            ->header($this->cards->id)
            ->hr()
            ->body($this->cards->content)
            ->build();

        $accessResponse = Http::post('https://bsky.social/xrpc/com.atproto.server.createSession', [
            'identifier' => $this->platform->config['identifier'],
            'password' =>  $this->platform->config['password'],
        ]);

        $path = str_replace(appUrl() . '/storage', 'public', $this->cards->getPicture());
        $type = Storage::mimeType($path);
        $file = Storage::get($path);
        $blobResponse = Http::withHeaders([
            'Authorization' => sprintf('Bearer %s', $accessResponse->json()['accessJwt']),
            'Accept' => $type,
            'Content-Type' => $type,
        ])->withBody($file, $type)->post('https://bsky.social/xrpc/com.atproto.repo.uploadBlob');

        $recordResponse = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => sprintf('Bearer %s', $accessResponse->json()['accessJwt']),
        ])->post('https://bsky.social/xrpc/com.atproto.repo.createRecord', [
            'repo' => $accessResponse->json()['did'],
            'collection' => 'app.bsky.feed.post',
            'record' => [
                '$type' => 'app.bsky.feed.post',
                'text' => $message,
                'createdAt' => now()->toIso8601ZuluString(),
                'langs' => [
                    'zh-TW',
                ],
                'embed' => [
                    '$type' => 'app.bsky.embed.images',
                    'images' => [
                        [
                            'alt' => $message,
                            'image' => $blobResponse->json()['blob'],
                        ],
                    ],
                ],
            ],
        ]);

        /**
         * 紀錄 response 資訊
         */
        activity('social cards - bsky publish')
            ->performedOn($this->cards)
            ->log($recordResponse->body());

        /**
         * 建立 PlatformCards 紀錄
         */
        $platform_string_id = str_replace(sprintf('at://%s/app.bsky.feed.post/', $accessResponse->json()['did']), '', $recordResponse->json()['uri']);
        $platformCard = $platformCardService->store([
            'platform_type' => Platform::TYPE_BSKY,
            'platform_id' => $this->platform->id,
            'platform_string_id' => $platform_string_id,
            'platform_url' => sprintf(
                'https://bsky.app/profile/%s/post/%s',
                $this->platform->config['pages_name'],
                $platform_string_id,
            ),
            'card_id' => $this->cards->id,
        ]);

        /**
         * 紀錄 PlatformCards
         */
        activity('social cards - bsky platform card')
            ->performedOn($platformCard)
            ->log(json_encode($platformCard));

        return;
    }
}
