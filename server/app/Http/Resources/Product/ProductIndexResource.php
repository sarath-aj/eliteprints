<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductIndexResource extends JsonResource
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
            'product_code' => $this->product_code,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'price_formatted' => $this->price_formatted,
            'price' => $this->price,
            'occasion' => $this->occasion,
            'brand_id' => $this->brand_id,
            'featured' => $this->featured,
            'gender' => $this->gender,
            'sleeve' => $this->sleeve,
            'neck' => $this->neck,
            'color' => $this->color,
            'fit' => $this->fit,
            'main_image' => $this->main_image,
            'image_gallery' => unserialize($this->image_gallery),
            'stock_count' => $this->stockCount(),
            'in_stock' => $this->inStock(),
        ];
    }
}
