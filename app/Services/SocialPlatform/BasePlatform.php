<?php

namespace App\Services\SocialPlatform;

use App\Models\Social\Platform;
use App\Repositories\Backend\Social\CardPostRepository;
use Illuminate\Container\Container;

/**
 * Class BasePlatform.
 */
abstract class BasePlatform implements PlatformContract
{
    /**
     * @var array
     */
    protected $config;

    /**
     * The platform model.
     *
     * @var Platform
     */
    protected $platform;

    /**
     * @var CardPostRepository
     */
    protected $cardPostRepository;

    /**
     * BasePlatform constructor.
     *
     * @param Platform $platform
     * @param CardPostRepository $cardPostRepository
     */
    public function __construct(Platform $platform)
    {
        $this->platform = $platform;
        $this->config = json_decode($this->platform->config, true);
        $this->cardPostRepository = Container::getInstance()->make(CardPostRepository::class);
    }
}
