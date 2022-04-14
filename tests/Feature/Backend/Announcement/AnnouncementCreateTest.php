<?php

namespace Tests\Feature\Backend\Announcement;

use App\Domains\Announcement\Models\Announcement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class AnnouncementCreateTest.
 *
 * @extends TestCase
 */
class AnnouncementCreateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_create_new_announcement()
    {
        $this->loginAsAdmin();

        $response = $this->post('/admin/announcement', [
            'type' => Announcement::TYPE_PRIMARY,
            'area' => Announcement::AREA_BACKEND,
            'message' => 'Testing Message.',
            'starts_at_date' => null,
            'starts_at_time' => null,
            'ends_at_date' => null,
            'ends_at_time' => null,
            'enabled' => '1',
        ]);

        $response->assertSessionHas(['flash_success' => __('The announcement was successfully created.')]);
    }
}
