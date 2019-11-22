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

    /**
     * @return bool
     */
    public function isPublish()
    {
        return ! $this->is_banned;
    }

    /**
     * @return bool
     */
    public function isBanned()
    {
        return $this->is_banned;
    }
}
