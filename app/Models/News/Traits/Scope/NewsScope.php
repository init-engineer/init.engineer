<?php

namespace App\Models\News\Traits\Scope;

/**
 * Class NewsScope.
 */
trait NewsScope
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
