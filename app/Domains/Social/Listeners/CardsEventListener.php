<?php

namespace App\Domains\Social\Listeners;

use App\Domains\Social\Events\Cards\ArticleCreated;
use App\Domains\Social\Events\Cards\PictureCreated;
use App\Domains\Social\Jobs\Publish\DiscordPublishJob;
use App\Domains\Social\Jobs\Publish\FacebookPublishJob;
use App\Domains\Social\Jobs\Publish\PlurkPublishJob;
use App\Domains\Social\Jobs\Publish\TelegramPublishJob;
use App\Domains\Social\Jobs\Publish\TumblrPublishJob;
use App\Domains\Social\Jobs\Publish\TwitterPublishJob;
use App\Domains\Social\Models\Cards;
use App\Domains\Social\Models\Platform;

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
            'id' => $event->cards->id,
        ));
    }

    /**
     * @param $event
     */
    public function onPictureCreated($event)
    {
        $this->notification(array(
            'id' => $event->cards->id,
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
         * 先把文章 ORM 物件抓出來
         */
        $card = Cards::find($data['id']);

        /**
         * 根據社群平台逐一通知
         */
        foreach ($platforms as $platform) {
            switch ($platform->type) {
                /**
                 * 丟給負責發表文章到 Facebook 的 Job
                 */
                case Platform::TYPE_FACEBOOK:
                    dispatch(new FacebookPublishJob($card, $platform))->onQueue('highest');
                    break;

                /**
                 * 丟給負責發表文章到 Twitter 的 Job
                 */
                case Platform::TYPE_TWITTER:
                    dispatch(new TwitterPublishJob($card, $platform))->onQueue('highest');
                    break;

                /**
                 * 丟給負責發表文章到 Plurk 的 Job
                 */
                case Platform::TYPE_PLURK:
                    dispatch(new PlurkPublishJob($card, $platform))->onQueue('highest');
                    break;

                /**
                 * 丟給負責發表文章到 Discord 的 Job
                 */
                case Platform::TYPE_DISCORD:
                    dispatch(new DiscordPublishJob($card, $platform))->onQueue('highest');
                    break;

                /**
                 * 丟給負責發表文章到 Tumblr 的 Job
                 */
                case Platform::TYPE_TUMBLR:
                    dispatch(new TumblrPublishJob($card, $platform))->onQueue('highest');
                    break;

                /**
                 * 丟給負責發表文章到 Telegram 的 Job
                 */
                case Platform::TYPE_TELEGRAM:
                    dispatch(new TelegramPublishJob($card, $platform))->onQueue('highest');
                    break;

                /**
                 * 其它並不在支援名單當中的社群
                 */
                default:
                    /**
                     * 直接把資料寫入 Activity log 以便日後查核
                     */
                    activity('social cards - undefined notification')
                        ->performedOn($card)
                        ->log(json_encode($data));
                    break;
            }
        }

        return;
    }
}
