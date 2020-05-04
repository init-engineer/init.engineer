<?php

namespace App\Models\Social\Traits\Scope;

/**
 * Trait AdsScope.
 */
trait AdsScope
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
