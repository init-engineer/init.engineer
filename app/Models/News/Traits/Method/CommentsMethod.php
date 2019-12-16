<?php

namespace App\Models\News\Traits\Method;

/**
 * Trait CommentsMethod.
 */
trait CommentsMethod
{
    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }
}
