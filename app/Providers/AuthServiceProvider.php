<?php

namespace App\Providers;

use Carbon\Carbon;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

/**
 * Class AuthServiceProvider.
 */
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
        Passport::tokensExpireIn(Carbon::now()->addDays(15));
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));
        Passport::personalAccessTokensExpireIn(Carbon::now()->addMonths(6));

        // Implicitly grant "Admin" role all permissions
        // This works in the app by using gate-related functions like auth()->user->can() and @can()
        Gate::before(function ($user) {
            return $user->hasRole(config('access.users.admin_role')) ? true : null;
            return $user->hasRole(config('access.users.junior_vip_role')) ? true : null;
            return $user->hasRole(config('access.users.senior_vip_role')) ? true : null;
            return $user->hasRole(config('access.users.junior_donate_role')) ? true : null;
            return $user->hasRole(config('access.users.senior_donate_role')) ? true : null;
            return $user->hasRole(config('access.users.junior_user_role')) ? true : null;
            return $user->hasRole(config('access.users.senior_user_role')) ? true : null;
            return $user->hasRole(config('access.users.junior_manager_role')) ? true : null;
            return $user->hasRole(config('access.users.senior_manager_role')) ? true : null;
        });
    }
}
