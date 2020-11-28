<?php

namespace App\Domains\Social\Models\Traits\Scope;

/**
 * Trait CardPostScope.
 */
trait CardPostScope
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
