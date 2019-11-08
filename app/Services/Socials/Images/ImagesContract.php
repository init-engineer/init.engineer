<?php

namespace App\Services\Socials\Images;

/**
 * Interface ImagesContract.
 */
interface ImagesContract
{
    public function buildImage(array $data);

    public function uploadImage(array $data, $avatar);
}
