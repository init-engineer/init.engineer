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
            'type' => $media->social_type,
            'connections' => $media->social_connections,
            // 'social_card_id' => $media->social_card_id,
            'url' => $media->getLink(),
            'like' => $media->num_like,
            'share' => $media->num_share,
        ];
    }
}
