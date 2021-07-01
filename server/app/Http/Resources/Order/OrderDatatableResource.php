<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Resources\Json\JsonResource;

// use App\Http\Resources\Product\ProductVariationResource;
// use App\Http\Resources\Addresses\AddressesResource;
// use App\Http\Resources\ShippingMethod\ShippingMethodResource;

class OrderDatatableResource extends JsonResource
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
            'ID' => $this->id,
            'Order Date' => $this->created_at->toDateTimeString(),
            'Customer Name' => $this->user->name,
            'Order Status' => $this->status,
            // 'Total' => $this->total()->formatted(),
            'Products' => count($this->products),
        ];
    }
}