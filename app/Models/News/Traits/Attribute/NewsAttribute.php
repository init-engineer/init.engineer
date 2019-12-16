<?php

namespace App\Models\News\Traits\Attribute;

/**
 * Trait NewsAttribute.
 */
trait NewsAttribute
{
    /**
     * @return mixed
     */
    public function getPictureAttribute()
    {
        return $this->getPicture();
    }
}
