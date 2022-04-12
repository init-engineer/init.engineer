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
        \App\Console\Commands\Social\ReviewsPublish::class,
        \App\Console\Commands\Social\PlatformCommentsUpdate::class,
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
         * 自動化 群眾審核相關功能
         */
        $schedule->command('social:reviews-publish')->everyMinute()->when(function () {
            return Crons::everySomeMinutes('social:reviews-publish', 10);
        });

        /**
         * 自動化 更新各社群平台的留言
         */
        $schedule->command('social:platform-comments-update')->everyMinute()->when(function () {
            return Crons::everySomeMinutes('social:platform-comments-update', 1);
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
