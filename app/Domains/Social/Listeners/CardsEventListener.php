<?php

namespace App\Domains\Social\Listeners;

use App\Domains\Social\Events\Cards\ArticleCreated;
use App\Domains\Social\Events\Cards\PictureCreated;
use App\Domains\Social\Models\Cards;
use App\Domains\Social\Models\Platform;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

/**
 * Class CardsEventListener.
 */
class CardsEventListener
{
    /**
     * @param $event
     */
    public function onArticleCreated($event)
    {
        $this->notification(array(
            'type' => 'article',
            'id' => $event->cards->id,
            'picture' => $event->cards->getPicture(),
            'content' => $event->cards->content,
            'created_at' => $event->cards->created_at,
        ));
    }

    /**
     * @param $event
     */
    public function onPictureCreated($event)
    {
        $this->notification(array(
            'type' => 'picture',
            'id' => $event->cards->id,
            'picture' => $event->cards->getPicture(),
            'content' => $event->cards->content,
            'created_at' => $event->cards->created_at,
        ));
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            ArticleCreated::class,
            'App\Domains\Social\Listeners\CardsEventListener@onArticleCreated'
        );

        $events->listen(
            PictureCreated::class,
            'App\Domains\Social\Listeners\CardsEventListener@onPictureCreated'
        );
    }

    /**
     * @param array $data
     *
     * @return void
     */
    private function notification(array $data): void
    {
        /**
         * 先把需要通知的社群平台抓出來
         */
        $platforms = Platform::where('action', Platform::ACTION_NOTIFICATION)
            ->active()
            ->get();

        /**
         * 整理需要發送出去的內容
         */
        $desc = ($data['type'] === 'article') ? '【文章投稿】' : '【圖片投稿】';
        $desc = $desc . "\n" . $data['content'];

        /**
         * 根據社群平台逐一通知
         */
        foreach ($platforms as $platform) {
            switch ($platform->type) {
                /**
                 * 發表到 Facebook
                 */
                case Platform::TYPE_FACEBOOK:
                    # code...
                    break;

                /**
                 * 發表到 Twitter
                 */
                case Platform::TYPE_TWITTER:
                    # code...
                    break;

                /**
                 * 發表到 Plurk
                 */
                case Platform::TYPE_PLURK:
                    # code...
                    break;

                /**
                 * 發表到 Discord
                 */
                case Platform::TYPE_DISCORD:
                    /**
                     * 判斷 Webhook URL 是否為空
                     */
                    if (!isset($platform->config['webhook'])) {
                        break;
                    }

                    /**
                     * 開始執行通知
                     */
                    $url = $platform->config['webhook'];
                    $response = Http::post($url, array(
                        'embeds' => array(
                            array(
                                'title' => '#' . appName() . base_convert($data['id'], 10, 36),
                                'url' => route('frontend.social.cards.show', $data['id']),
                                'description' => Str::limit($desc, 128, '...'),
                                'color' => 15258703,
                                'image' => array(
                                    'url' => $data['picture'],
                                ),
                                'timestamp' => $data['created_at'],
                            ),
                        ),
                    ));

                    activity('social cards - discord notification')
                        ->performedOn(Cards::find($data['id']))
                        ->log($response->body());
                    break;

                /**
                 * 發表到 Tumblr
                 */
                case Platform::TYPE_TUMBLR:
                    # code...
                    break;

                /**
                 * 發表到 Telegram
                 */
                case Platform::TYPE_TELEGRAM:
                    /**
                     * 判斷 Access token 與 Chat ID 是否為空
                     */
                    if (!isset($platform->config['chat_id']) ||
                        !isset($platform->config['access_token'])) {
                        break;
                    }

                    $token = $platform->config['access_token'];
                    $url = "https://api.telegram.org/bot$token/sendPhoto";
                    $response = Http::post($url, array(
                        'chat_id' => $platform->config['chat_id'],
                        'photo' => $data['picture'],
                        'caption' => Str::limit($desc, 128, '...'),
                    ));

                    activity('social cards - telegram notification')
                        ->performedOn(Cards::find($data['id']))
                        ->log($response->body());
                    break;

                /**
                 * 其它並不在支援名單當中的社群
                 */
                default:
                    # code...
                    break;
            }
        }
    }
}
