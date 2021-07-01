<?php

namespace App\Http\Controllers\Api\Color;

use App\Http\Controllers\Controller;
use App\Http\Resources\Color\ColorCollection;
use App\Models\Product;
use Illuminate\Http\Request;

class ColorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ColorCollection(Product::select('color')->groupBy('color')->get());
    }
}
