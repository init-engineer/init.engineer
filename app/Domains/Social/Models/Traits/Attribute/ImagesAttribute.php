<?php

namespace App\Domains\Social\Models\Traits\Attribute;

/**
 * Trait ImagesAttribute.
 */
trait ImagesAttribute
{
    /**
     * @return Storage
     */
    public function getFileAttribute()
    {
        return $this->getFile();
    }

    /**
     * @return mixed
     */
    public function getPictureAttribute()
    {
        return $this->getPicture();
    }
}
