<?php

namespace App\Domains\Social\Models\Traits\Scope;

/**
 * Trait CardsScope.
 */
trait CardsScope
{
    /**
     * @param      $query
     * @param bool $status
     *
     * @return mixed
     */
    public function scopeActive($query, $status = true)
    {
        return $query->where('active', $status);
    }

    /**
     * @param      $query
     * @param bool $status
     *
     * @return mixed
     */
    public function scopePublish($query, $status = false)
    {
        return $query->where('banned', $status);
    }

    /**
     * @param      $query
     * @param bool $status
     *
     * @return mixed
     */
    public function scopeBanned($query, $status = true)
    {
        return $query->where('banned', $status);
    }
}
