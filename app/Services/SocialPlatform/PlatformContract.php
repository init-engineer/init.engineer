<?php

namespace App\Services\SocialPlatform;

use App\Models\Social\Cards;

/**
 * Interface PlatformContract.
 */
interface PlatformContract
{
    public function publish(Cards $cards);

    public function deleted(Cards $cards);
}
