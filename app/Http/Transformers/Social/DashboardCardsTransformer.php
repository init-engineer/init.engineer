<?php

namespace App\Http\Transformers\Social;

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
     * @return array
     */
    public function transform(Cards $cards)
    {
        return [
            'id' => $cards->id,
            'content' => $cards->content,
            'image' => $cards->images->first()->getPicture(),
            'is_banned' => $cards->is_banned,
            'banned_remarks' => $cards->banned_remarks,
            'created_at' => $cards->created_at,
            'created_diff' => $cards->created_at->diffForHumans(),
            'updated_at' => $cards->updated_at,
            'updated_diff' => $cards->updated_at->diffForHumans(),
        ];
    }
}
