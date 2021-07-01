<?php

namespace App\Http\Resources\Addresses;

use App\Http\Resources\Country\CountryResource;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressesResource extends JsonResource
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
            'name' => $this->name,
            'address' => $this->address,
            'state' => $this->state,
            'city' => $this->city,
            'postal_code' => $this->postal_code,
            'country' => new CountryResource($this->country),
            'country_id' => $this->country->id,
            'is_default' => $this->is_default,
        ];
    }
}
