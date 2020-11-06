<?php

namespace Tests\Feature\Frontend;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class UserDashboardTest.
 */
class UserDashboardTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function unauthenticated_users_cant_access_the_dashboard()
    {
        $this->get('/dashboard')->assertRedirect('/login');
    }
}
