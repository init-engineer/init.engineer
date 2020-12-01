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

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeOnlyActive($query)
    {
        return $query->whereActive(true);
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeOnlyDeactivated($query)
    {
        return $query->whereActive(false);
    }
}
