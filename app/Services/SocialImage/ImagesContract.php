<?php

namespace App\Services\SocialImage;

/**
 * Interface ImagesContract.
 */
interface ImagesContract
{
    public function buildImage(array $data);

    public function uploadImage(array $data, $avatar);
}
