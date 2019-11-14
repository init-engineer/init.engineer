<?php

namespace App\Http\Transformers\Social;

use App\Models\Social\MediaCards;
use League\Fractal\TransformerAbstract;

/**
 * Class MediaCardsTransformer.
 */
class MediaCardsTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param MediaCards $media
     * @return array
     */
    public function transform(MediaCards $media)
    {
        return [
            'social_type' => $media->social_type,
            'social_connections' => $media->social_connections,
            'social_card_id' => $media->social_card_id,
            'social_url' => $media->getLink(),
            'num_like' => $media->num_like,
            'num_share' => $media->num_share,
        ];
    }
}
