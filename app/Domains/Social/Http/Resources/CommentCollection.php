<?php

namespace App\Domains\Social\Http\Resources;

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
        return [
            'data' => $this->collection,
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
