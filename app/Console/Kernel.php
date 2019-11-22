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
        $schedule->command('social:media-cards-update all')->daily()->withoutOverlapping();
        $schedule->command('social:media-cards-update 12')->hourly()->withoutOverlapping();
        $schedule->command('social:media-cards-update 4')->everyFiveMinutes()->withoutOverlapping();
        $schedule->command('social:media-cards-update 1')->everyMinute()->withoutOverlapping();

        /**
         * 自動化 對社群平台爬蟲更新留言
         */
        $schedule->command('social:media-cards-update all')->daily();
        $schedule->command('social:media-cards-update 12')->hourly();
        $schedule->command('social:media-cards-update 4')->everyFiveMinutes();
        $schedule->command('social:media-cards-update 1')->everyMinute();

        /**
         * 自動化 執行任務、重新執行 Jobs 失敗的任務
         */
        $schedule->command('queue:work --daemon --quiet --queue=default --delay=3 --sleep=3 --tries=3')->everyMinute()->withoutOverlapping();
        $schedule->command('queue:retry all')->everyFiveMinutes()->withoutOverlapping();

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
