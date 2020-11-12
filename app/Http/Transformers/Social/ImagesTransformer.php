<?php

namespace App\Http\Transformers\Social;

use League\Fractal\TransformerAbstract;

/**
 * Class ImagesTransformer.
 */
class ImagesTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param $images
     *
     * @return array
     */
    public static function transform($images)
    {
        $image = function ($images) {
            switch ($images->count()) {
                case 0:
                    return null;

                case 1:
                    return $images->first()->getPicture();

                default:
                    $resultImages = [];
                    foreach ($images as $image) {
                        array_push($resultImages, $image->getPicture());
                    }
                    return $resultImages;
            }
        };

        return $image($images);
    }
}
