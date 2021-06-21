<?php

namespace App\Domains\Social\Models\Traits\Scope;

/**
 * Trait AdsScope.
 */
trait AdsScope
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
            $query->where('name', 'like', '%' . $term . '%');
        });
    }

    /**
     * @param $query
     * @param bool $status
     *
     * @return mixed
     */
    public function scopeRender($query, $status = true)
    {
        return $query->where('render', $status);
    }

    /**
     * @param $query
     * @param bool $status
     *
     * @return mixed
     */
    public function scopePayment($query, $status = true)
    {
        return $query->where('payment', $status);
    }

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
