<?php

namespace App\Console;

use App\Domains\Crons\Models\Crons;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

/**
 * Class Kernel.
 *
 * @extends ConsoleKernel
 */
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\Social\PlatformCardsPublish::class,
        \App\Console\Commands\Social\PlatformCommentsUpdate::class,
        \App\Console\Commands\Social\ReviewsPublish::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     *
     * @return void
     */
    protected function schedule(Schedule $schedule): void
    {
        /**
         * 每隔 1 分鐘
         * 根據 cache index 去循序更新各社群平台的留言
         */
        $schedule->command('social:platform-comments-update')->everyMinute()->when(function () {
            return Crons::everySomeMinutes('social:platform-comments-update', 1);
        });

        /**
         * 每隔 10 分鐘
         * 檢查群眾審核相關功能，判斷是否有需要發表的文章
         */
        $schedule->command('social:reviews-publish')->everyMinute()->when(function () {
            return Crons::everySomeMinutes('social:reviews-publish', 10);
        });

        /**
         * 每隔 1 小時
         * 重新檢查新發表的文章是否有尚未執行到的通知
         */
        $schedule->command('social:platform-card-notification')->everyMinute()->when(function () {
            return Crons::everySomeMinutes('social:platform-card-notification', 60);
        });

        /**
         * 每隔 1 小時
         * 重新檢查群眾審核相關功能，是否有遺漏尚未發表到社群平台的文章
         */
        $schedule->command('social:platform-card-publish')->everyMinute()->when(function () {
            return Crons::everySomeMinutes('social:platform-card-publish', 60);
        });

        /**
         * 每隔 1 小時
         * 重新排程 failed_job 過往失敗的任務。
         */
        $schedule->command('queue:retry all')->everyMinute()->when(function () {
            return Crons::everySomeMinutes('queue:retry all', 60);
        });

        /**
         * Crons Example:
         */
        // $schedule->command('command')->everyMinute()->when(function () {
        //     return Crons::everySomeMinutes('command', 10);
        // });
        // $schedule->command('command')->everyMinute()->when(function () {
        //     return Crons::dailyAt('command', 'time');
        // });
        // $schedule->command('command')->everyMinute()->when(function () {
        //     return Crons::weeklyAt('command', 'days', 'time');
        // });
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
