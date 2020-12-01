<?php

namespace App\Domains\Social\Models\Traits\Scope;

/**
 * Trait PlatformScope.
 */
trait PlatformScope
{
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
