<?php

namespace App\Domains\Companie\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class CompanieResource.
 */
class CompanieResource extends JsonResource
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
            'uuid' => $this->uuid,
            'name' => $this->name,
            'logo' => $this->getLogo(),
            'banner' => $this->getBanner(),
            'pictures' => $this->getPictures(),
            'area' => $this->area,
            'address' => $this->address,
            'scale' => $this->scale,
            'tax' => $this->tax,
            'capital' => $this->capital,
            'email' => $this->email,
            'phone' => $this->phone,
            'description' => $this->description,
            'content' => $this->content,
            'active' => $this->active,
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
        ];
    }
}
