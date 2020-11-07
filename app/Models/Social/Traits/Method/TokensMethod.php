<?php

namespace App\Models\Social\Traits\Method;

/**
 * Trait TokensMethod.
 */
trait TokensMethod
{
    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }
}
