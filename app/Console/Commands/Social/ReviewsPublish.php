<?php

namespace App\Console\Commands\Social;

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
             * 20      >= 90%,  < 10%
             * 30      >= 80%,  < 15%
             * 50      >= 70%,  < 20%
             * 100     >= 60%,  < 30%
             */
            $yes = $card->reviews()->where('point', '>=', 1)->count();
            $no  = $card->reviews()->where('point', '<=', -1)->count();
            $count = $yes + $no;
            if ($count >= 100 && $yes / $count >= 0.60 && $no / $count < 0.30) {
                $result = true;
            } else if ($count >= 50 && $yes / $count >= 0.70 && $no / $count < 0.20) {
                $result = true;
            } else if ($count >= 30 && $yes / $count >= 0.80 && $no / $count < 0.15) {
                $result = true;
            } else if ($count >= 20 && $yes / $count >= 0.90 && $no / $count < 0.10) {
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
                 * 根據社群平台逐一發佈
                 */
                foreach ($platforms as $platform) {
                    switch ($platform) {
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
                            # code...
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
                            # code...
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

        return 0;
    }
}
