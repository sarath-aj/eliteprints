<?php

namespace App\Http\Controllers\Api\Countries;

use App\Http\Controllers\Controller;
use App\Http\Resources\Country\CountryResource;
use App\Models\Country;

class CountryController extends Controller
{
    public function index()
    {
        return CountryResource::collection(
            Country::get()
        );
    }
}
