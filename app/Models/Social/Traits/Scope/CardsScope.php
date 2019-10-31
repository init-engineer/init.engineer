<?php

namespace App\Models\Social\Traits\Scope;

/**
 * Class CardsScope.
 */
trait CardsScope
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
