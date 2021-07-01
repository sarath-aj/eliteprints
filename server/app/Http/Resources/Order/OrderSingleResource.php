<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Product\ProductVariationResourceCustomer;
use App\Http\Resources\Addresses\AddressesResource;
use App\Http\Resources\ShippingMethod\ShippingMethodResource;

// use App\Http\Resources\Product\ProductIndexResource;

class OrderSingleResource extends JsonResource
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
            'order_date' => $this->created_at->toDateTimeString(),
            'customer_name' => $this->user->name,
            'customer_email' => $this->user->email,
            'customer_mobile' => $this->user->mobile,
            'status' => $this->status,
            // 'subtotal' => $this->subtotal->formatted(),
            'subtotal' => $this->subtotalUnformatted,
            'total' => $this->totalUnformatted(),
            'products' => ProductVariationResourceCustomer::collection($this->whenLoaded('products')),
            'shipping_address' => new AddressesResource($this->whenLoaded('address')),
            'shippingMethod' => new ShippingMethodResource($this->whenLoaded('shippingMethod')),
            'payment_method' => $this->paymentMethod,
        ];
    }
}