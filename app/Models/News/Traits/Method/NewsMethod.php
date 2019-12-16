<?php

namespace App\Models\News\Traits\Method;

/**
 * Trait NewsMethod.
 */
trait NewsMethod
{
    /**
     * @throws \Illuminate\Container\EntryNotFoundException
     * @return bool|\Illuminate\Contracts\Routing\UrlGenerator|mixed|string
     */
    public function getPicture()
    {
        return url('storage/'.$this->image);
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }
}
