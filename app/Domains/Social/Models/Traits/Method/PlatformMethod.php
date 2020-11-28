<?php

namespace App\Domains\Social\Models\Traits\Method;

/**
 * Trait PlatformMethod.
 */
trait PlatformMethod
{
    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }
}
