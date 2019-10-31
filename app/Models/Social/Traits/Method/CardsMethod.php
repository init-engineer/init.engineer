<?php

namespace App\Models\Social\Traits\Method;

/**
 * Trait CardsMethod.
 */
trait CardsMethod
{
    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }
}
