<?php

namespace App\Models\Social\Traits\Method;

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
