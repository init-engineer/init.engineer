<?php

namespace App\Models\Social\Traits\Attribute;

/**
 * Trait ImagesAttribute.
 */
trait ImagesAttribute
{
    /**
     * @return mixed
     */
    public function getPictureAttribute()
    {
        return $this->getPicture();
    }
}
