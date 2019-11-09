<?php

namespace App\Models\Social\Traits\Scope;

/**
 * Trait MediaCardsScope.
 */
trait MediaCardsScope
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
