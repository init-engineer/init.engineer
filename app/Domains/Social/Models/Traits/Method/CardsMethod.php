<?php

namespace App\Domains\Social\Models\Traits\Method;

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

    /**
     * @return bool
     */
    public function isPublish()
    {
        return !$this->banned;
    }

    /**
     * @return bool
     */
    public function isBanned()
    {
        return $this->banned;
    }
}
