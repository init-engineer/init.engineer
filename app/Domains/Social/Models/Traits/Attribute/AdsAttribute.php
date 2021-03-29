<?php

namespace App\Domains\Social\Models\Traits\Attribute;

/**
 * Trait AdsAttribute.
 */
trait AdsAttribute
{
    /**
     * @return mixed
     */
    public function getPictureAttribute()
    {
        return $this->getPicture();
    }
}
