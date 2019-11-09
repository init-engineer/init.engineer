<?php

namespace App\Models\Social\Traits\Method;

/**
 * Trait MediaCardsMethod.
 */
trait MediaCardsMethod
{
    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }
}
