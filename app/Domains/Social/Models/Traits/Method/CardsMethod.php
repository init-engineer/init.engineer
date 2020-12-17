<?php

namespace App\Domains\Social\Models\Traits\Method;

use Illuminate\Support\Facades\Storage;

/**
 * Trait CardsMethod.
 */
trait CardsMethod
{
    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @return bool
     */
    public function isPublish(): bool
    {
        return !$this->banned;
    }

    /**
     * @return bool
     */
    public function isBanned(): bool
    {
        return $this->banned;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        $image = json_decode($this->image, true);
        if (isset($image['storage'])) {
            switch ($image['storage']) {
                case 'storage':
                    return Storage::url(sprintf('%s/%s.%s', $image['path'], $image['name'], $image['type']));
            }
        }

        return '';
    }
}
