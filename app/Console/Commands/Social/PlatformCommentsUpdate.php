<?php

namespace App\Console\Commands\Social;

use App\Domains\Social\Jobs\Comments\DiscordCommentsJob;
use App\Domains\Social\Jobs\Comments\FacebookCommentsJob;
use App\Domains\Social\Jobs\Comments\PlurkCommentsJob;
use App\Domains\Social\Jobs\Comments\TelegramCommentsJob;
use App\Domains\Social\Jobs\Comments\TumblrCommentsJob;
use App\Domains\Social\Jobs\Comments\TwitterCommentsJob;
use App\Domains\Social\Models\Cards;
use App\Domains\Social\Models\Platform;
use App\Domains\Social\Services\CommentsService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

/**
 * Class PlatformCommentsUpdate.
 *
 * @extends Command
 */
class PlatformCommentsUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'social:platform-comments-update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '檢查所有社群平台的留言資訊。';

    /**
     * 每次更新的文章數量。
     *
     * @var int
     */
    protected $rowSize = 1;

    /**
     * @var Platform
     */
    protected $platform;

    /**
     * @var CommentsService
     */
    protected $commentsService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CommentsService $commentsService)
    {
        parent::__construct();

        $this->commentsService = $commentsService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /**
         * 抓出該次需要更新 Comments 的列表
         */
        $indexCache = Cache::get($this->signature . ':index', 1);
        $indexFirst = Cards::orderBy('id', 'desc')->pluck('id')->first();
        $indexList = Cards::where('id', '>=', $indexCache)->pluck('id')->take($this->rowSize)->all();
        foreach ($indexList as $index) {
            $cards = Cards::find($index);
            foreach ($cards->platformCards as $platformCard) {
                /**
                 * 針對 Platform 去推送不同的 Jobs 更新
                 */
                switch ($platformCard->platform_type) {
                    case Platform::TYPE_LOCAL:
                        // Do nothing.
                        break;

                    case Platform::TYPE_FACEBOOK:
                        dispatch(new FacebookCommentsJob($platformCard->platform, $platformCard))->onQueue('lowest');
                        break;

                    case Platform::TYPE_TWITTER:
                        dispatch(new TwitterCommentsJob($platformCard->platform, $platformCard))->onQueue('lowest');
                        break;

                    case Platform::TYPE_PLURK:
                        dispatch(new PlurkCommentsJob($platformCard->platform, $platformCard))->onQueue('lowest');
                        break;

                    case Platform::TYPE_TUMBLR:
                        dispatch(new TumblrCommentsJob($platformCard->platform, $platformCard))->onQueue('lowest');
                        break;

                    case Platform::TYPE_DISCORD:
                        dispatch(new DiscordCommentsJob($platformCard->platform, $platformCard))->onQueue('lowest');
                        break;

                    case Platform::TYPE_TELEGRAM:
                        dispatch(new TelegramCommentsJob($platformCard->platform, $platformCard))->onQueue('lowest');
                        break;
                }
            }
        }

        /**
         * 更新 Cache index 的值
         */
        if (($indexCache + $this->rowSize) >= $indexFirst) {
            $indexNext = 1;
        } else {
            $indexNext = Cards::where('id', '>', end($indexList))->pluck('id')->first();
        }
        Cache::set($this->signature . ':index', $indexNext);

        return Command::SUCCESS;
    }
}
