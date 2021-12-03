<?php

namespace App\Console\Commands\Social;

use Illuminate\Console\Command;

/**
 * Class PlatformCommentsUpdate.
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
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /**
         * 運作邏輯
         *
         * 1. 最新發表的文章需要階段性更新留言，每 5 分鐘更新 1 次，每個小時更新頻率 12 次。
         * 2. 前 20 篇文章需要階段性更新留言，每 20 分鐘更新 1 次，每個小時更新頻率 60 次。
         * 3. 循環更新所有文章的留言，每 1 分鐘搜尋 1 篇文章，每個小時更新頻率 60 次。
         */

        return Command::SUCCESS;
    }
}
