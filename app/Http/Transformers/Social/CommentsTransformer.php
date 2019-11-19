<?php

namespace App\Http\Transformers\Social;

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
     * @return array
     */
    public function transform(Comments $comments)
    {
        $media = isset($comments->media)? [
            'type' => $comments->media->social_type,
            'connections' => $comments->media->social_connections,
        ] : [
            'type' => 'platform',
            'connections' => 'primary',
        ];

        return [
            'name' => $comments->user_name,
            'avatar' => $comments->user_avatar,
            'content' => $comments->content,
            'created' => $comments->created_at->diffForHumans(),
            'media' => $media,
        ];
    }
}
