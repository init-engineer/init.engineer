<?php

namespace App\Domains\Social\Http\Resources;

use Carbon\Carbon;
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
        $created_at = new Carbon($this->created_at);

        return [
            'id' => $this->id,
            'user_name' => $this->user_name,
            'user_avatar' => $this->user_avatar,
            'content' => $this->content,
            'created_at' => $created_at->diffForHumans(),
        ];
    }
}
