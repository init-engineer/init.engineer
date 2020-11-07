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
    public function isConfirmed()
    {
        return $this->confirmed;
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
