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
use App\Domains\Social\Models\PlatformCards;
use Carbon\Carbon;
use Illuminate\Console\Command;

/**
 * Class PlatformCardsPublish.
 *
 * @extends Command
 */
class PlatformCardsPublish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'social:platform-card-publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '檢查近期通過群眾審核的文章，是否有被發表到社群平台。';

    /**
     * 勿擾模式
     * 當天 21:00 ~ 隔日 09:00
     * 深夜、凌晨不進行社群平台發布
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
    protected $delayMinutes = 60;

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
        echo "[$startCarbonString] 檢查近期通過群眾審核的文章，是否有被發表到社群平台。\n\r";
        echo "========================================\n\r";

        /**
         * 當天 21:00 ~ 隔日 09:00
         * 深夜、凌晨不進行社群平台發布
         */
        if ($this->doNotDisturbMode) {
            $hour = Carbon::now('Asia/Taipei')->hour;
            if ($hour >= $this->doNotDisturbStart ||
                $hour <= $this->doNotDisturbEnd) {
                // echo something ...

                return 0;
            }
        }

        /**
         * 如果過去 60 分鐘內，有文章被審核通過的話，那就不進行審核文章的動作。
         */
        if ($this->delayMode) {
            $card = Cards::where('active', 1)->orderBy('updated_at', 'DESC')->first();
            $now = Carbon::now()->subMinutes($this->delayMinutes);

            if ($now->timestamp <= $card->updated_at->timestamp) {
                // echo something ...

                return 0;
            }
        }

        /**
         * 抓出 3 天以內，群眾審核通過、尚未被刪除的文章
         */
        $cards = Cards::whereDate('created_at', '>=', Carbon::now()->subDays(3))
            ->active(true)
            ->blockade(false)
            ->get();

        /**
         * 先把需要發表的社群平台抓出來
         */
        $platforms = Platform::where('action', Platform::ACTION_PUBLISH)
            ->active()
            ->pluck('id')
            ->all();

        /**
         * 逐一檢查文章是否有被發表到社群平台
         */
        foreach ($cards as $card) {
            /**
             * 爬出該文章目前發表到的社群平台當中的資料
             * 透過 array_diff 來找出還沒有發表過去的社群平台
             */
            $platformCards = $card->platformCards->whereIn('platform_id', $platforms)->pluck('platform_id')->all();
            $platformDiff = array_diff($platforms, $platformCards);

            /**
             * 有社群平台還沒被發表到
             */
            if (count($platformDiff) != 0) {
                /**
                 * foreach 每個社群平台 ID
                 * 並透過任務排程再排一次任務
                 */
                foreach ($platformDiff as $platformID) {
                    $platform = Platform::find($platformID);

                    /**
                     * 如果過去 60 分鐘內，有文章被發表到 $platform 社群平台的話，那就不進行排程
                     */
                    if ($this->delayMode) {
                        $platformCard = PlatformCards::where('platform_id', $platform->id)->orderBy('updated_at', 'DESC')->first();
                        $now = Carbon::now()->subMinutes($this->delayMinutes);

                        if ($now->timestamp <= $platformCard->updated_at->timestamp) {
                            // echo something ...

                            continue;
                        }
                    }

                    switch ($platform->type) {
                        /**
                         * 丟給負責發表文章到 Facebook 的 Job
                         */
                        case Platform::TYPE_FACEBOOK:
                            dispatch(new FacebookPublishJob($card, $platform));
                            break;

                        /**
                         * 丟給負責發表文章到 Twitter 的 Job
                         */
                        case Platform::TYPE_TWITTER:
                            dispatch(new TwitterPublishJob($card, $platform));
                            break;

                        /**
                         * 丟給負責發表文章到 Plurk 的 Job
                         */
                        case Platform::TYPE_PLURK:
                            dispatch(new PlurkPublishJob($card, $platform));
                            break;

                        /**
                         * 丟給負責發表文章到 Discord 的 Job
                         */
                        case Platform::TYPE_DISCORD:
                            dispatch(new DiscordPublishJob($card, $platform));
                            break;

                        /**
                         * 丟給負責發表文章到 Tumblr 的 Job
                         */
                        case Platform::TYPE_TUMBLR:
                            dispatch(new TumblrPublishJob($card, $platform));
                            break;

                        /**
                         * 丟給負責發表文章到 Telegram 的 Job
                         */
                        case Platform::TYPE_TELEGRAM:
                            dispatch(new TelegramPublishJob($card, $platform));
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
                                ->log(json_encode($card));
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
        echo "[$endCarbonString] 完成檢查近期通過群眾審核的文章，是否有被發表到社群平台。\n\r";
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
