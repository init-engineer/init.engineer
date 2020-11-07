<?php

namespace App\Models\Social\Traits\Scope;

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
     * @param bool $confirmed
     *
     * @return mixed
     */
    public function scopeConfirmed($query, $confirmed = true)
    {
        return $query->where('confirmed', $confirmed);
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
