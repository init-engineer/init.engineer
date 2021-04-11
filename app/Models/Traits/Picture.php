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
        if (isset($this->picture) &&
            $this->picture !== null) {
            $picture = json_decode($this->picture, true);
            if (isset($picture['imgur']['link']) &&
                isset($picture['imgur']['type']) &&
                $picture['imgur']['link'] !== null &&
                $picture['imgur']['type'] !== null) {
                return asset(sprintf(
                    '%s.%s',
                    $picture['imgur']['link'],
                    $picture['imgur']['type']));
            }

            if (isset($picture['storage']['path']) &&
                isset($picture['storage']['name']) &&
                isset($picture['storage']['type']) &&
                $picture['storage']['path'] !== null &&
                $picture['storage']['name'] !== null &&
                $picture['storage']['type'] !== null) {
                return asset(sprintf(
                    '%s%s.%s',
                    $picture['storage']['path'],
                    $picture['storage']['name'],
                    $picture['storage']['type']));
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
        $picture['storage']['path'] = $data['storage']['path'] ?? $picture['storage']['path'] ?? null;
        $picture['storage']['name'] = $data['storage']['name'] ?? $picture['storage']['name'] ?? null;
        $picture['storage']['type'] = $data['storage']['type'] ?? $picture['storage']['type'] ?? null;
        $picture['imgur']['link'] = $data['imgur']['link'] ?? $picture['imgur']['link'] ?? null;
        $picture['imgur']['type'] = $data['imgur']['type'] ?? $picture['imgur']['type'] ?? null;

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
                    'storage' => array(
                        'path' => null,
                        'name' => null,
                        'type' => null,
                    ),
                    'imgur' => array(
                        'link' => null,
                        'type' => null,
                    ),
                ));
            }
        });
    }
}
