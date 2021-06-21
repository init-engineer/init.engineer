<?php

namespace App\Domains\Social\Models\Traits\Scope;

/**
 * Trait CardsScope.
 */
trait CardsScope
{
    /**
     * @param $query
     * @param $term
     *
     * @return mixed
     */
    public function scopeSearch($query, $term)
    {
        return $query->where(function ($query) use ($term) {
            $query->Where('content', 'like', '%' . $term . '%');
        });
    }

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
        return $query->where('blockade', $status);
    }

    /**
     * @param      $query
     * @param bool $status
     *
     * @return mixed
     */
    public function scopeBlockade($query, $status = true)
    {
        return $query->where('blockade', $status);
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
