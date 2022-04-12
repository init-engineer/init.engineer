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
 *
 * @extends Command
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
     * 勿擾模式
     * 當天 22:00 ~ 隔日 08:00
     * 深夜、凌晨不進行審核文章
     *
     * @var bool
     */
    protected $doNotDisturbMode = true;

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
         * 紀錄執行時的時間戳記
         */
        $startCarbonTime = Carbon::now('Asia/Taipei');
        $startCarbonString = $startCarbonTime->format('H:m:s');

        echo "========================================\n\r";
        echo "[$startCarbonString] 開始進行檢查群眾審核，並且將通過門檻的文章發表到社群平台。\n\r";
        echo "========================================\n\r";

        /**
         * 當天 22:00 ~ 隔日 08:00
         * 深夜、凌晨不進行審核文章
         */
        if ($this->doNotDisturbMode) {
            $hour = Carbon::now('Asia/Taipei')->hour;
            if ($hour >= 22 || $hour <= 8) {
                // echo something ...

                return 0;
            }
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
                            dispatch(new FacebookPublishJob($model, $platform));
                            break;

                            /**
                             * 丟給負責發表文章到 Twitter 的 Job
                             */
                        case Platform::TYPE_TWITTER:
                            dispatch(new TwitterPublishJob($model, $platform));
                            break;

                            /**
                             * 丟給負責發表文章到 Plurk 的 Job
                             */
                        case Platform::TYPE_PLURK:
                            dispatch(new PlurkPublishJob($model, $platform));
                            break;

                            /**
                             * 丟給負責發表文章到 Discord 的 Job
                             */
                        case Platform::TYPE_DISCORD:
                            dispatch(new DiscordPublishJob($model, $platform));
                            break;

                            /**
                             * 丟給負責發表文章到 Tumblr 的 Job
                             */
                        case Platform::TYPE_TUMBLR:
                            dispatch(new TumblrPublishJob($model, $platform));
                            break;

                            /**
                             * 丟給負責發表文章到 Telegram 的 Job
                             */
                        case Platform::TYPE_TELEGRAM:
                            dispatch(new TelegramPublishJob($model, $platform));
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

        /**
         * 紀錄結束時的時間戳記
         */
        $endCarbonTime = Carbon::now('Asia/Taipei');
        $endCarbonString = $startCarbonTime->format('H:m:s');

        /**
         * 計算整個 Command 執行時間
         */
        $diffCarbonTimeSeconds = $startCarbonTime->diffInSeconds($endCarbonTime);
        $diffHours = (int) ($diffCarbonTimeSeconds / 3600);
        $diffMinutes = (int) (($diffCarbonTimeSeconds - ($diffHours * 3600)) / 60);
        $diffSeconds = $diffCarbonTimeSeconds - ($diffHours * 3600) - ($diffMinutes * 60);

        /**
         * 輸出報表
         */
        echo "========================================\n\r";
        echo "[$endCarbonString] 完成群眾審核，並且將通過門檻的文章發表到社群平台。\n\r";
        echo sprintf(
            "總共耗時 %s:%s:%s\n\r",
            str_pad($diffHours, 2, '0', STR_PAD_LEFT),
            str_pad($diffMinutes, 2, '0', STR_PAD_LEFT),
            str_pad($diffSeconds, 2, '0', STR_PAD_LEFT),
        );
        echo "========================================\n\r";

        return Command::SUCCESS;
    }
}
