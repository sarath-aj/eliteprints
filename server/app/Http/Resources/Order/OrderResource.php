<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Product\ProductVariationResource;
use App\Http\Resources\Addresses\AddressesResource;
use App\Http\Resources\ShippingMethod\ShippingMethodResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'subtotal' => $this->subtotal->formatted(),
            // 'total' => $this->total()->formatted(),
            'total' => $this->totalUnformatted(),
            'created_at' => $this->created_at->toDateTimeString(),
            'products' => ProductVariationResource::collection($this->whenLoaded('products')),
            'address' => new AddressesResource($this->whenLoaded('address')),
            'shippingMethod' => new ShippingMethodResource($this->whenLoaded('shippingMethod'))
        ];
    }
}
