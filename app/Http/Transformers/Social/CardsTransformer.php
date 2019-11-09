<?php

namespace App\Http\Transformers\Social;

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
     * @return array
     */
    public function transform(Cards $cards)
    {
        return [
            'id' => $cards->id,
            'content' => $cards->content,
            // 'image' => $cards->images->first()->getPicture(),
            // 'comments' => $cards->comments,
            // 'media' => $cards->medias,
            'created_at' => $cards->created_at,
            'updated_at' => $cards->updated_at,
        ];
    }
}
