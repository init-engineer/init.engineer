<?php

namespace App\Domains\Social\Models\Traits\Attribute;

/**
 * Trait CardsAttribute.
 */
trait CardsAttribute
{
    /**
     * @return mixed
     */
    public function getPictureAttribute()
    {
        return $this->getPicture();
    }
}
