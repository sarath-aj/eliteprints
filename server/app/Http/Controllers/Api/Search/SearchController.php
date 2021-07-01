<?php

namespace App\Http\Controllers\Api\Search;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

use App\Http\Resources\Product\ProductCollection;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        if ($request->has('s')) {
            $results = Product::where('name', 'like', '%'.$request->get('s').'%')->paginate(12);
        } else {
            $results = Product::get();
        }
        return new ProductCollection($results);
    }
}
