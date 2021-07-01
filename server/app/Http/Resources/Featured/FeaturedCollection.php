<?php

namespace App\Http\Resources\Featured;

use Illuminate\Http\Resources\Json\ResourceCollection;

class FeaturedCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'featured_products'  =>  parent::toArray($request),
        ];
    }
}
