<?php

namespace App\Models\Social\Traits\Scope;

/**
 * Trait CommentsScope.
 */
trait CommentsScope
{
    /**
     * @param $query
     * @param bool $status
     *
     * @return mixed
     */
    public function scopeActive($query, $status = true)
    {
        return $query->where('active', $status);
    }
}
