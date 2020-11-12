<?php

namespace App\Http\Transformers\Social;

use App\Http\Transformers\Traits\DateTransformer;
use App\Models\Social\Comments;
use League\Fractal\TransformerAbstract;

/**
 * Class CommentsTransformer.
 */
class CommentsTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param Comments $comments
     *
     * @return array
     */
    public function transform(Comments $comments)
    {
        return array(
            'name' => $comments->user_name,
            'avatar' => $comments->user_avatar,
            'content' => $comments->content,
            'created_at' => DateTransformer::transform($comments->created_at),
            'updated_at' => DateTransformer::transform($comments->updated_at),
            'media' => array(
                'name' => $comments->platform->name,
                'type' => $comments->platform->type,
            ),
        );
    }
}
