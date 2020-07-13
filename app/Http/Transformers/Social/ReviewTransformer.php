<?php

namespace App\Http\Transformers\Social;

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

        return [
            'id' => $cards->id,
            'content' => $cards->content,
            'image' => ($cards->images->first() !== null) ? $cards->images->first()->getPicture() : null,
            'succeeded' => $succeeded,
            'failed' => $failed,
            'created_at' => $cards->created_at,
            'created_diff' => $cards->created_at->diffForHumans(),
            'updated_at' => $cards->updated_at,
            'updated_diff' => $cards->updated_at->diffForHumans(),
        ];
    }
}
