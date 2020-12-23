<?php

namespace App\Domains\Social\Services\Platform;

use App\Domains\Social\Models\Platform;

/**
 * Class AbstractProvider.
 */
abstract class AbstractProvider implements ProviderContract
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
     * AbstractProvider constructor.
     *
     * @param Platform $platform
     */
    public function __construct(Platform $platform)
    {
        $this->platform = $platform;
        $this->config = json_decode($platform->config, true);
    }
}
