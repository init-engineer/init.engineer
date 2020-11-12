<?php

namespace App\Http\Transformers\Social;

use App\Http\Transformers\Traits\DateTransformer;
use App\Models\Social\Cards;
use League\Fractal\TransformerAbstract;

/**
 * Class ReviewTransformer.
 */
class ReviewTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param Cards $cards
     *
     * @return array
     */
    public function transform(Cards $cards)
    {
        $succeeded = 0;
        $failed = 0;
        foreach ($cards->reviews as $review) {
            if ($review->point > 0) {
                $succeeded = $succeeded + $review->point;
            } else {
                $failed = $failed + $review->point;
            }
        }

        return array(
            'id' => $cards->id,
            'content' => $cards->content,
            'image' => ImagesTransformer::transform($cards->images),
            'succeeded' => $succeeded,
            'failed' => $failed,
            'created_at' => DateTransformer::transform($cards->created_at),
            'updated_at' => DateTransformer::transform($cards->updated_at),
        );
    }
}
