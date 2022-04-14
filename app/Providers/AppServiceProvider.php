<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider.
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Fix for MySQL < 5.7.7 and MariaDB < 10.2.2
         * https://laravel.com/docs/master/migrations#creating-indexes
         *
         * Answer: https://github.com/laravel/framework/issues/27806
         */
        Schema::defaultStringLength(191);

        // Force SSL in production
        if ($this->app->environment() === 'production')
        {
            URL::forceScheme('https');
        }

        Paginator::useBootstrap();
    }
}
