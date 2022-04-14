<?php

namespace App\Domains\Social\Models\Traits\Method;

/**
 * Trait CommentsMethod.
 */
trait CommentsMethod
{
    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @return bool
     */
    public function isInactive(): bool
    {
        return !$this->active;
    }

    /**
     * @return bool
     */
    public function isPublish(): bool
    {
        return !$this->blockade;
    }

    /**
     * @return bool
     */
    public function isBlockade(): bool
    {
        return $this->blockade;
    }
}
