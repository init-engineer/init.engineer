<?php

namespace App\Http\Transformers\Social;

use App\Models\Social\CardPost;
use League\Fractal\TransformerAbstract;

/**
 * Class CardPostTransformer.
 */
class CardPostTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param CardPost $post
     *
     * @return array
     */
    public function transform(CardPost $post)
    {
        return array(
            'type' => $post->social_type,
            'connections' => $post->social_connections,
            'url' => $post->getLink(),
            'like' => $post->num_like,
            'share' => $post->num_share,
        );
    }
}
