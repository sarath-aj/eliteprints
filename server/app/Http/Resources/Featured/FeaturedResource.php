<?php

namespace App\Http\Resources\Featured;

use Illuminate\Http\Resources\Json\JsonResource;

class FeaturedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price,
            'price_formatted' => $this->price_formatted,
            'main_image' => $this->main_image,
        ];
    }
}
