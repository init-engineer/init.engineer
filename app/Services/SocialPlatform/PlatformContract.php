<?php

namespace App\Services\SocialPlatform;

use App\Models\Social\Cards;
use App\Services\SocialContent\ContentFluent;

/**
 * Interface PlatformContract.
 */
interface PlatformContract
{
    public function publish(Cards $cards, ContentFluent $contentFluent);

    public function deleted(Cards $cards);
}
