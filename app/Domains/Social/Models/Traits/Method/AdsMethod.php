<?php

namespace App\Domains\Social\Models\Traits\Method;

/**
 * Trait AdsMethod.
 */
trait AdsMethod
{
    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }
}
