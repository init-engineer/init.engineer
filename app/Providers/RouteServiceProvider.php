<?php

namespace App\Providers;

use App\Domains\Auth\Models\User;
use App\Domains\Companie\Models\CompanieJobs;
use App\Domains\Companie\Models\Companies;
use App\Domains\Social\Models\Ads;
use App\Domains\Social\Models\Platform;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

/**
 * Class RouteServiceProvider.
 */
class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));

            // For the 'Login As' functionality from the 404labfr/laravel-impersonate package
            Route::middleware('web')
                ->group(function (Router $router) {
                    $router->impersonate();
                });
        });

        // To be able to restore a user, since the default binding is a find and would result in a 404
        Route::bind('deletedUser', function ($id) {
            return User::onlyTrashed()->find($id);
        });

        // To be able to restore a ads, since the default binding is a find and would result in a 404
        Route::bind('deletedAds', function ($id) {
            return Ads::onlyTrashed()->find($id);
        });

        // To be able to restore a platform, since the default binding is a find and would result in a 404
        Route::bind('deletedPlatform', function ($id) {
            return Platform::onlyTrashed()->find($id);
        });

        // To be able to restore a companie, since the default binding is a find and would result in a 404
        Route::bind('companie', function ($companie) {
            if (is_a($companie, Companies::class)) {
                return Companies::uuid($companie->uuid)->first();
            } else {
                return Companies::uuid($companie)->first();
            }
        });

        // To be able to restore a job, since the default binding is a find and would result in a 404
        Route::bind('job', function ($job) {
            if (is_a($job, CompanieJobs::class)) {
                return CompanieJobs::uuid($job->uuid)->first();
            } else {
                return CompanieJobs::uuid($job)->first();
            }
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
