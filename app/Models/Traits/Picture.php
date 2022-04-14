<?php

namespace App\Models\Traits;

/**
 * Trait Picture.
 */
trait Picture
{
    /**
     * @return string
     */
    public function getPicture(): string
    {
        if (isset($this->picture) && $this->picture !== null) {
            if (isset($this->picture['imgur']) && $this->picture['imgur'] !== null) {
                return $this->picture['imgur'];
            }

            if (isset($this->picture['storage']) && $this->picture['storage'] !== null) {
                return asset('storage/' . $this->picture['storage']);
            }

            if (isset($this->picture['local']) && $this->picture['local'] !== null) {
                return asset($this->picture['local']);
            }
        }

        return asset('img/default/960x240.png');
    }

    /**
     * @return string
     */
    public function getPictureName(): string
    {
        return property_exists($this, 'pictureName') ? $this->pictureName : 'picture';
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function setPicture(array $data): bool
    {
        $picture = $this->picture;
        $picture['local'] = $data['local'] ?? $this->picture['local'] ?? null;
        $picture['storage'] = $data['storage'] ?? $this->picture['storage'] ?? null;
        $picture['imgur'] = $data['imgur'] ?? $picture['imgur'] ?? null;

        $this->picture = $picture;

        return $this->save();
    }

    /**
     * Use Laravel bootable traits.
     *
     * @return void
     */
    protected static function bootPicture(): void
    {
        static::creating(function ($model) {
            if (!$model->{$model->getPictureName()}) {
                $model->{$model->getPictureName()} = [
                    'local' => null,
                    'storage' => null,
                    'imgur' => null,
                ];
            }
        });
    }
}
