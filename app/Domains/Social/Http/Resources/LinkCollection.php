<?php

namespace App\Domains\Social\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class LinkCollection.
 */
class LinkCollection extends ResourceCollection
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
            return [
                'type' => $item->platform_type,
                'url' => $item->platform_url,
            ];
        });
    }
}
