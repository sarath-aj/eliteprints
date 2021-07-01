<?php

namespace App\Http\Controllers\Api\Addresses;

use App\Http\Resources\ShippingMethod\ShippingMethodResource;
use App\Models\Address;
use App\Http\Controllers\Controller;

class AddressShippingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(Address $address)
    {
        // check if the user owns the address
        $this->authorize('show', $address);

        return ShippingMethodResource::collection(
            $address->country->shippingMethods
        );
    }
}