<?php

namespace App\Models\Auth\Traits\Method;

/**
 * Trait RoleMethod.
 */
trait RoleMethod
{
    /**
     * @return mixed
     */
    public function isAdmin()
    {
        return $this->name === config('access.users.admin_role');
    }

    /**
     * @return mixed
     */
    public function isJuniorVIP()
    {
        return $this->name === config('access.users.junior_vip_role');
    }

    /**
     * @return mixed
     */
    public function isSeniorVIP()
    {
        return $this->name === config('access.users.senior_vip_role');
    }

    /**
     * @return mixed
     */
    public function isJuniorDonate()
    {
        return $this->name === config('access.users.junior_donate_role');
    }

    /**
     * @return mixed
     */
    public function isSeniorDonate()
    {
        return $this->name === config('access.users.senior_donate_role');
    }

    /**
     * @return mixed
     */
    public function isJuniorUser()
    {
        return $this->name === config('access.users.junior_user_role');
    }

    /**
     * @return mixed
     */
    public function isSeniorUser()
    {
        return $this->name === config('access.users.senior_user_role');
    }

    /**
     * @return mixed
     */
    public function isJuniorManager()
    {
        return $this->name === config('access.users.junior_manager_role');
    }

    /**
     * @return mixed
     */
    public function isSeniorManager()
    {
        return $this->name === config('access.users.senior_manager_role');
    }
}
