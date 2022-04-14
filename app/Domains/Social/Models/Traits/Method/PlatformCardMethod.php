<?php

namespace App\Domains\Social\Models\Traits\Method;

/**
 * Trait PlatformCardMethod.
 */
trait PlatformCardMethod
{
    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }
}
