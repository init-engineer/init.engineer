<?php

namespace App\Http\Transformers\Social;

use App\Http\Transformers\Traits\DateTransformer;
use App\Models\Social\Cards;
use League\Fractal\TransformerAbstract;

/**
 * Class DashboardCardsTransformer.
 */
class DashboardCardsTransformer extends TransformerAbstract
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
        $banned = function ($cards) {
            if ($cards->isBanned()) {
                return array(
                    'remarks' => $cards->banned_remarks,
                    'banned_at' => DateTransformer::transform($cards->banned_at),
                );
            } else {
                return false;
            }
        };

        return array(
            'id' => $cards->id,
            'content' => $cards->content,
            'image' => ImagesTransformer::transform($cards->images),
            'banned' => $banned($cards),
            'created_at' => DateTransformer::transform($cards->created_at),
            'updated_at' => DateTransformer::transform($cards->updated_at),
        );
    }
}
