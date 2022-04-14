<?php

namespace App\Domains\Crons\Models\Traits\Method;

use App\Domains\Crons\Models\Crons;
use Carbon\Carbon;

/**
 * Trait CronsMethod.
 */
trait CronsMethod
{
    /**
     * @param string $command
     * @param int    $minutes
     *
     * @return bool
     */
    public static function everySomeMinutes(string $command, int $minutes = 10): bool
    {
        $cron = Crons::find($command);
        $now  = Carbon::now();

        if ($cron && $cron->next_run > $now->timestamp) {
            return false;
        }

        Crons::updateOrCreate(
            [
                'command'  => $command,
            ],
            [
                'next_run' => Carbon::now()->addMinutes($minutes)->timestamp,
                'last_run' => Carbon::now()->timestamp,
            ]
        );

        return true;
    }

    /**
     * @param string $command
     * @param string $daily
     *
     * @return bool
     */
    public static function dailyAt(string $command, string $daily = '00:00'): bool
    {
        $cron = Crons::find($command);
        $now  = Carbon::now();

        if ($cron && $cron->next_run > $now->timestamp) {
            return false;
        }

        $_now_carbon = Carbon::now()->addDay()->format('Y-m-d');
        $_now_string = sprintf('%s %s:00', $_now_carbon, $daily);
        $_next_timestamp = Carbon::parse($_now_string)->timestamp;

        Crons::updateOrCreate(
            [
                'command'  => $command,
            ],
            [
                'next_run' => $_next_timestamp,
                'last_run' => Carbon::now()->timestamp,
            ]
        );

        return true;
    }

    /**
     * @param string $command
     * @param string $weekly
     * @param string $daily
     *
     * @return bool
     */
    public static function weeklyAt(string $command, string $weekly = 'sundays', string $daily = '00:00'): bool
    {
        $cron = Crons::find($command);
        $now  = Carbon::now();

        if ($cron && $cron->next_run > $now->timestamp) {
            return false;
        }

        $_next_weekly = 0;
        switch ($weekly) {
            case 'mondays':
                $_next_weekly = 0;
                break; # 星期一
            case 'tuesdays':
                $_next_weekly = 1;
                break; # 星期二
            case 'wednesdays':
                $_next_weekly = 2;
                break; # 星期三
            case 'thursdays':
                $_next_weekly = 3;
                break; # 星期四
            case 'fridays':
                $_next_weekly = 4;
                break; # 星期五
            case 'saturdays':
                $_next_weekly = 5;
                break; # 星期六
            case 'sundays':
                $_next_weekly = 6;
                break; # 星期日
        }

        $_weekday = Carbon::now()->weekday();
        if ($_weekday > $_next_weekly) {
            $_next = 7 - $_weekday;
        } else if ($_weekday < $_next_weekly) {
            $_next = $_next_weekly - $_weekday;
        } else {
            $_next = 7;
        }

        $_now_carbon = Carbon::now()->addDays($_next)->format('Y-m-d');
        $_now_string = sprintf('%s %s:00', $_now_carbon, $daily);
        $_next_timestamp = Carbon::parse($_now_string)->timestamp;

        Crons::updateOrCreate(
            [
                'command'  => $command,
            ],
            [
                'next_run' => $_next_timestamp,
                'last_run' => Carbon::now()->timestamp,
            ]
        );

        return true;
    }

    /**
     * @param string $command
     *
     * @return bool
     */
    public static function checkRun(string $command): bool
    {
        $cron = Crons::find($command);
        $now  = Carbon::now();

        if ($cron && $cron->next_run > $now->timestamp) {
            return false;
        }

        return true;
    }
}
