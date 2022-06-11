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
     * 當天 {start}:00 ~ 隔日 {end}:00
     * start = doNotDisturbStart
     * end   = doNotDisturbEnd
     *
     * 深夜、凌晨盡量不進行社群平台發布
     *
     * @var bool
     */
    protected $doNotDisturbMode = true;

    /**
     * 勿擾模式 開始時間
     *
     * @var int
     */
    protected $doNotDisturbStart = 21;

    /**
     * 勿擾模式 結束時間
     *
     * @var int
     */
    protected $doNotDisturbEnd = 9;

    /**
     * 延遲模式
     * 社群文章如果在 $delayMinutes 分鐘內，已經有通過文章的話，
     * 那就先暫時休息避免短時間通過大量文章，造成洪流攻擊社群平台而遭處置。
     *
     * @var bool
     */
    protected $delayMode = true;

    /**
     * 延遲分鐘數
     *
     * @var int
     */
    protected $delayMinutes = 120;

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
         * 當天 {start}:00 ~ 隔日 {end}:00
         * start = doNotDisturbStart
         * end   = doNotDisturbEnd
         *
         * 深夜、凌晨盡量不進行社群平台發布
         */
        if ($this->doNotDisturbMode) {
            $hour = Carbon::now('Asia/Taipei')->hour;
            if ($hour >= $this->doNotDisturbStart ||
                $hour <= $this->doNotDisturbEnd) {
                // echo something ...

                return Command::INVALID;
            }
        }

        /**
         * 如果過去 $this->delayMinutes 分鐘內，有文章被審核通過的話，那就不進行審核文章的動作。
         */
        if ($this->delayMode) {
            $card = Cards::where('active', 1)->orderBy('updated_at', 'DESC')->first();
            $now = Carbon::now()->subMinutes($this->delayMinutes);

            if ($now->timestamp <= $card->updated_at->timestamp) {
                // echo something ...

                return Command::INVALID;
            }
        }

        /**
         * 抓出 14 天以內，尚未發表、尚未被刪除的文章
         */
        $cards = Cards::whereDate('created_at', '>=', Carbon::now()->subDays(14))
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
             * 投票人數 同意配重
             * 10      >= 100%
             * 20      >= 95%
             * 30      >= 90%
             * 40      >= 85%
             * 50      >= 80%
             */
            $yes = $card->reviews()->where('point', '>=', 1)->count();
            $no  = $card->reviews()->where('point', '<=', -1)->count();
            $count = $yes + $no;
            if ($count >= 50 && ($yes / $count) >= 0.80) {
                $result = true;
            } else if ($count >= 40 && ($yes / $count) >= 0.85) {
                $result = true;
            } else if ($count >= 30 && ($yes / $count) >= 0.90) {
                $result = true;
            } else if ($count >= 20 && ($yes / $count) >= 0.95) {
                $result = true;
            } else if ($count >= 10 && ($yes / $count) >= 1.00) {
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
                    switch ($platform->type) {
                        /**
                         * 丟給負責發表文章到 Facebook 的 Job
                         */
                        case Platform::TYPE_FACEBOOK:
                            dispatch(new FacebookPublishJob($model, $platform))->onQueue('highest');
                            break;

                            /**
                             * 丟給負責發表文章到 Twitter 的 Job
                             */
                        case Platform::TYPE_TWITTER:
                            dispatch(new TwitterPublishJob($model, $platform))->onQueue('highest');
                            break;

                            /**
                             * 丟給負責發表文章到 Plurk 的 Job
                             */
                        case Platform::TYPE_PLURK:
                            dispatch(new PlurkPublishJob($model, $platform))->onQueue('highest');
                            break;

                            /**
                             * 丟給負責發表文章到 Discord 的 Job
                             */
                        case Platform::TYPE_DISCORD:
                            dispatch(new DiscordPublishJob($model, $platform))->onQueue('highest');
                            break;

                            /**
                             * 丟給負責發表文章到 Tumblr 的 Job
                             */
                        case Platform::TYPE_TUMBLR:
                            dispatch(new TumblrPublishJob($model, $platform))->onQueue('highest');
                            break;

                            /**
                             * 丟給負責發表文章到 Telegram 的 Job
                             */
                        case Platform::TYPE_TELEGRAM:
                            dispatch(new TelegramPublishJob($model, $platform))->onQueue('highest');
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

                return Command::SUCCESS;
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
