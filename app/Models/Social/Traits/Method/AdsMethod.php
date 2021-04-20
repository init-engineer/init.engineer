<?php

namespace App\Models\Social\Traits\Method;

/**
 * Trait AdsMethod.
 */
trait AdsMethod
{
    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @return bool
     */
    public function isRender()
    {
        return $this->render;
    }
}
