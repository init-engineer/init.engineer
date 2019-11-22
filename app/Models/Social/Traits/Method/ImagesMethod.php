<?php

namespace App\Models\Social\Traits\Method;

use Illuminate\Support\Facades\Storage;

/**
 * Trait ImagesMethod.
 */
trait ImagesMethod
{
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
        if (isset($this->imgur_url))
        {
            return $this->imgur_url;
        }

        switch ($this->storage)
        {
            case 'gravatar':
                if (! $size)
                {
                    $size = config('gravatar.default.size');
                }
                return gravatar()->get($this->email, ['size' => $size]);

            case 'storage':
                return url(sprintf('storage/%s/%s.%s', str_replace('public/', '', $this->avatar_path), $this->avatar_name, $this->avatar_type));
        }

        return false;
    }
}
