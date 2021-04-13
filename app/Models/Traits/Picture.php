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
        if (isset($this->picture) && $this->picture !== null) {
            $picture = json_decode($this->picture, true);
            if (isset($picture['imgur']) && $picture['imgur'] !== null) {
                return $picture['imgur'];
            }

            if (isset($picture['storage']) && $picture['storage'] !== null) {
                return asset('storage/' . $picture['storage']);
            }

            if (isset($picture['local']) && $picture['local'] !== null) {
                return asset($picture['local']);
            }
        }

        return asset('img/default/960x240.png');
    }

    /**
     * @return array
     */
    public function getPictureJson()
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
     * @param array $data
     *
     * @return bool
     */
    public function setPicture(array $data)
    {
        $picture = json_decode($this->picture, true);
        $picture['local'] = $data['local'] ?? $picture['local'] ?? null;
        $picture['storage'] = $data['storage'] ?? $picture['storage'] ?? null;
        $picture['imgur'] = $data['imgur'] ?? $picture['imgur'] ?? null;

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
                $model->{$model->getPictureName()} = json_encode(array(
                    'local' => null,
                    'storage' => null,
                    'imgur' => null,
                ));
            }
        });
    }
}
