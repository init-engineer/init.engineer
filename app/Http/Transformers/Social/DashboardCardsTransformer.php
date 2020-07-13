<?php

namespace App\Http\Transformers\Social;

use App\Models\Social\Cards;
use League\Fractal\TransformerAbstract;
use GrahamCampbell\Markdown\Facades\Markdown;

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
            'image' => ($cards->images->first() !== null)? $cards->images->first()->getPicture() : null,
            'is_banned' => $cards->is_banned,
            'banned_remarks' => isset($cards->banned_remarks)? Markdown::convertToHtml($cards->banned_remarks) : null,
            'created_at' => $cards->created_at,
            'created_diff' => $cards->created_at->diffForHumans(),
            'updated_at' => $cards->updated_at,
            'updated_diff' => $cards->updated_at->diffForHumans(),
        ];
    }
}
