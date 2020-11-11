<?php

namespace App\Services\SocialPlatform;

/**
 * Class BasePlatform.
 */
abstract class BasePlatform implements PlatformContract
{
    /**
     * The platform model.
     *
     * @var Platform
     */
    protected $model;
}
