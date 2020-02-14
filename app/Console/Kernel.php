<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

/**
 * Class Kernel.
 */
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\Backup\Database::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     */
    protected function schedule(Schedule $schedule)
    {
        /**
         * 自動化 資料庫備份
         */
        $schedule->command('backup:database')->daily()->at('23:00');

        /**
         * 自動化 對社群平台爬蟲更新 Likes、分享數。
         */
        // $schedule->command('social:media-cards-update all')->daily();
        $schedule->command('social:media-cards-update 24')->hourly();
        $schedule->command('social:media-cards-update 6')->everyTenMinutes();
        $schedule->command('social:media-cards-update 2')->everyFiveMinutes();
        // $schedule->command('social:media-cards-update 1')->everyMinute();

        /**
         * 自動化 對社群平台爬蟲更新留言
         */
        // $schedule->command('social:comments-update all')->daily();
        $schedule->command('social:comments-update 24')->hourly();
        $schedule->command('social:comments-update 6')->everyTenMinutes();
        $schedule->command('social:comments-update 2')->everyFiveMinutes();
        // $schedule->command('social:comments-update 1')->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
