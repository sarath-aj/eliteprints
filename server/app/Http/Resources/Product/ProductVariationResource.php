<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;
use App\Money\Money;


use App\Http\Resources\Product\ProductIndexResource;

class ProductVariationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|Collection
     */
    public function toArray($request)
    {
        if ($this->resource instanceof Collection) {
            return self::collection($this->resource)->resolve($request);
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'price_formatted' => $this->price_formatted,
            'price' => $this->price,
            'price_varies' => $this->priceVaries(),
            'stock_count' => (int) $this->stockCount(),
            'type' => $this->type->name,
            'in_stock' => $this->inStock(),
            'product' => new ProductIndexResource($this->whenLoaded('product')),
        ];
    }
}
