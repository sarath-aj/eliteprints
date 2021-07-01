<?php

namespace App\Http\Controllers\Api\Featured;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Resources\Featured\FeaturedResource;
use App\Http\Resources\Featured\FeaturedCollection;

class FeaturedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new FeaturedCollection(FeaturedResource::collection((Product::where('featured', '=', 1)->take(15)->get())));
    }
}