<?php

namespace App\Domains\Social\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class CommentCollection.
 */
class CommentCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($item) {
            $created_at = new Carbon($item->created_at);

            return [
                'id' => $item->id,
                'user_name' => $item->user_name,
                'user_avatar' => $item->user_avatar,
                'content' => $item->content,
                'created_at' => $created_at->diffForHumans(),
                'replys' => CommentResource::collection($item->replys),
            ];
        });
    }
}
