<?php

namespace App\Console\Commands\Social;

use App\Domains\Social\Jobs\Publish\DiscordPublishJob;
use App\Domains\Social\Jobs\Publish\FacebookPublishJob;
use App\Domains\Social\Jobs\Publish\PlurkPublishJob;
use App\Domains\Social\Jobs\Publish\TelegramPublishJob;
use App\Domains\Social\Jobs\Publish\TumblrPublishJob;
use App\Domains\Social\Jobs\Publish\TwitterPublishJob;
use App\Domains\Social\Models\Cards;
use App\Domains\Social\Models\Platform;
use App\Domains\Social\Services\CardsService;
use Carbon\Carbon;
use Illuminate\Console\Command;

/**
 * Class ReviewsPublish.
 */
class ReviewsPublish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'social:reviews-publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '檢查群眾審核，並且將通過門檻的文章發表到社群平台。';

    /**
     * @var CardsService
     */
    protected $service;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CardsService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /**
         * 當天 22:00 ~ 隔日 08:00
         * 深夜、凌晨不審文章
         */
        $hour = Carbon::now('Asia/Taipei')->hour;
        if ($hour >= 22 || $hour <= 8) {
            return 0;
        }

        /**
         * 抓出 14 天以內，尚未發表、尚未被刪除的文章
         */
        $cards = Cards::whereDate('created_at', '>=', Carbon::now()->addDays(-14))
            ->active(false)
            ->blockade(false)
            ->get();

        /**
         * 先把需要發表的社群平台抓出來
         */
        $platforms = Platform::where('action', Platform::ACTION_PUBLISH)
            ->active()
            ->get();

        /**
         * 逐一檢核文章是否有達標
         */
        foreach ($cards as $card) {
            /**
             * 規則表
             * 投票人數 同意配重 否決配重
             * 20      >= 100%, < 0%
             * 30      >= 95%,  < 0%
             * 50      >= 90%,  < 5%
             * 100     >= 80%,  < 10%
             */
            $yes = $card->reviews()->where('point', '>=', 1)->count();
            $no  = $card->reviews()->where('point', '<=', -1)->count();
            $count = $yes + $no;
            if ($count >= 100 && $yes / $count >= 0.80 && $no / $count < 0.10) {
                $result = true;
            } else if ($count >= 50 && $yes / $count >= 0.90 && $no / $count < 0.05) {
                $result = true;
            } else if ($count >= 30 && $yes / $count >= 0.95 && $no / $count < 0.00) {
                $result = true;
            } else if ($count >= 20 && $yes / $count >= 1.00 && $no / $count < 0.00) {
                $result = true;
            } else {
                $result = false;
            }

            /**
             * 根據規則結果
             */
            if ($result) {
                /**
                 * 將文章切換為已認證狀態
                 */
                $model = $this->service->mark($card, true);

                /**
                 * 通知投稿者文章通過審核
                 */
                $model->sendPublishNotification();

                /**
                 * 根據社群平台逐一發佈
                 */
                foreach ($platforms as $platform) {
                    switch ($platform) {
                        /**
                         * 丟給負責發表文章到 Facebook 的 Job
                         */
                        case Platform::TYPE_FACEBOOK:
                            FacebookPublishJob::dispatch($model, $platform);
                            break;

                        /**
                         * 丟給負責發表文章到 Twitter 的 Job
                         */
                        case Platform::TYPE_TWITTER:
                            TwitterPublishJob::dispatch($model, $platform);
                            break;

                        /**
                         * 丟給負責發表文章到 Plurk 的 Job
                         */
                        case Platform::TYPE_PLURK:
                            PlurkPublishJob::dispatch($model, $platform);
                            break;

                        /**
                         * 丟給負責發表文章到 Discord 的 Job
                         */
                        case Platform::TYPE_DISCORD:
                            DiscordPublishJob::dispatch($model, $platform);
                            break;

                        /**
                         * 丟給負責發表文章到 Tumblr 的 Job
                         */
                        case Platform::TYPE_TUMBLR:
                            TumblrPublishJob::dispatch($model, $platform);
                            break;

                        /**
                         * 丟給負責發表文章到 Telegram 的 Job
                         */
                        case Platform::TYPE_TELEGRAM:
                            TelegramPublishJob::dispatch($model, $platform);
                            break;

                        /**
                         * 其它並不在支援名單當中的社群
                         */
                        default:
                            /**
                             * 直接把資料寫入 Activity log 以便日後查核
                             */
                            activity('social cards - undefined publish')
                                ->performedOn($card)
                                ->log(json_encode($model));
                            break;
                    }
                }
            }
        }

        return Command::SUCCESS;
    }
}
