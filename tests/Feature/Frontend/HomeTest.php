<?php

namespace Tests\Feature\Frontend;

use Tests\TestCase;

/**
 * Class HomeTest.
 *
 * @extends TestCase
 */
class HomeTest extends TestCase
{
    /** @test */
    public function the_home_page_exists()
    {
        $this->get('/')->assertOk();
    }
}
