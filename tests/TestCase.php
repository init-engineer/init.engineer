<?php

namespace Tests;

use App\Domains\Auth\Http\Middleware\TwoFactorAuthenticationStatus;
use App\Domains\Auth\Models\Role;
use App\Domains\Auth\Models\User;
use Illuminate\Auth\Middleware\RequirePassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

/**
 * Class TestCase.
 *
 * @extends BaseTestCase
 */
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication,
        RefreshDatabase;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        Artisan::call('db:seed');

        $this->withoutMiddleware(RequirePassword::class);
        $this->withoutMiddleware(TwoFactorAuthenticationStatus::class);
    }

    /**
     * @return Role
     */
    protected function getAdminRole(): Role
    {
        return Role::find(1);
    }

    /**
     * @return User
     */
    protected function getMasterAdmin(): User
    {
        return User::find(1);
    }

    /**
     * @param bool $admin = false
     */
    protected function loginAsAdmin($admin = false)
    {
        if (!$admin) {
            $admin = $this->getMasterAdmin();
        }

        $this->actingAs($admin);

        return $admin;
    }

    /**
     * ...
     */
    protected function logout()
    {
        return auth()->logout();
    }
}
