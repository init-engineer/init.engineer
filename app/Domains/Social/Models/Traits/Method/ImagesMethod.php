<?php

namespace App\Domains\Social\Models\Traits\Method;

use Illuminate\Support\Facades\Storage;

/**
 * Trait ImagesMethod.
 */
trait ImagesMethod
{
    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @return Storage
     */
    public function getFile()
    {
        $file_path = sprintf(
            '%s/%s.%s',
            $this->avatar_path,
            $this->avatar_name,
            $this->avatar_type
        );

        return Storage::get($file_path);
    }

    /**
     * @param bool $size
     *
     * @throws \Illuminate\Container\EntryNotFoundException
     * @return bool|\Illuminate\Contracts\Routing\UrlGenerator|mixed|string
     */
    public function getPicture($size = false)
    {
        switch ($this->storage) {
            case 'storage':
                return url(sprintf('storage/%s/%s.%s', str_replace('public/', '', $this->path), $this->name, $this->type));
        }

        return false;
    }
}
