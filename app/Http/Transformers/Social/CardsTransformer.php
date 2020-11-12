<?php

namespace App\Http\Transformers\Social;

use App\Http\Transformers\Traits\DateTransformer;
use App\Models\Social\Cards;
use League\Fractal\TransformerAbstract;

/**
 * Class CardsTransformer.
 */
class CardsTransformer extends TransformerAbstract
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
        return array(
            'id' => $cards->id,
            'content' => $cards->content,
            'image' => ImagesTransformer::transform($cards->images),
            'created_at' => DateTransformer::transform($cards->created_at),
            'updated_at' => DateTransformer::transform($cards->updated_at),
        );
    }
}
