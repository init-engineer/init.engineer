<?php

namespace App\Domains\Social\Services\Image;

/**
 * Interface ImagesContract.
 */
interface ImagesContract
{
    public function buildImage(array $data);

    public function uploadImage(array $data, $avatar);
}
