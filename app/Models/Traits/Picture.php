<?php

namespace App\Models\Traits;

/**
 * Trait Picture.
 */
trait Picture
{
    /**
     * @return array
     */
    public function getPicture()
    {
        if ($this->picture !== null) {
            return json_decode($this->picture, true);
        }

        return array();
    }

    /**
     * @return string
     */
    public function getPictureName()
    {
        return property_exists($this, 'pictureName') ? $this->pictureName : 'picture';
    }

    /**
     * @param array $picture
     *
     * @return bool
     */
    public function setPicture(array $picture)
    {
        $this->picture = json_encode($picture);

        return $this->save();
    }

    /**
     * Use Laravel bootable traits.
     */
    protected static function bootPicture()
    {
        static::creating(function ($model) {
            if (!$model->{$model->getPictureName()}) {
                $model->{$model->getPictureName()} = '{}';
            }
        });
    }
}
