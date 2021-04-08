<?php

namespace App\Domains\Auth\Models\Traits\Scope;

use App\Domains\Auth\Models\User;

/**
 * Class UserScope.
 */
trait UserScope
{
    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeOnlyDeactivated($query)
    {
        return $query->whereActive(false);
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
     * @param $type
     *
     * @return mixed
     */
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeAllAccess($query)
    {
        return $query->whereHas('roles', function ($query) {
            $query->where('name', config('boilerplate.access.role.admin'));
        });
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeAdmins($query)
    {
        return $query->where('type', User::TYPE_ADMIN);
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeUsers($query)
    {
        return $query->where('type', User::TYPE_USER);
    }
}
