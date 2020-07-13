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
            'image' => ($cards->images->first() !== null)? $cards->images->first()->getPicture() : null,
            'created_at' => $cards->created_at,
            'created_diff' => $cards->created_at->diffForHumans(),
            'updated_at' => $cards->updated_at,
            'updated_diff' => $cards->updated_at->diffForHumans(),
        ];
    }
}
