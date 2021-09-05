<?php

namespace App\Domains\Social\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class CommentResource.
 */
class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_name' => $this->user_name,
            'user_avatar' => $this->user_avatar,
            'content' => $this->content,
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
