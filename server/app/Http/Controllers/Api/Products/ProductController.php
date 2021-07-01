<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Requests\Product\ProductVariationRequest;
use App\Http\Requests\Product\ProductUpdateVariationRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Http\Requests\Product\ProductMainImageRequest;
use App\Http\Requests\Product\ProductImageGalleryRequest;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use App\Models\Stock;
use App\Models\ProductVariation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ProductCollection(Product::paginate(20));
    }

    public function filterProducts($gender, Request $request)
    {
        return new ProductCollection(
            Product::where('gender', '=', $gender)->latest()->filter($request)->paginate(12)
        );
    }

    public function allProductsFilter(Request $request)
    {
        return new ProductCollection(
            Product::latest()->filter($request)->paginate(12)
        );
    }

    public function productsSitemap()
    {
        return new ProductCollection(
            Product::all()
        );
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = new Product;
        $product->product_code = $request->product_code;
        $product->name = $request->name;
        $product->slug = Str::slug($request->slug);
        $product->description = $request->description;
        $product->price = $request->price;
        $product->featured = $request->featured;
        $product->occasion = $request->occasion;
        $product->brand_id = $request->brand_id;
        $product->gender = $request->gender;
        $product->sleeve = $request->sleeve;
        $product->neck = $request->neck;
        $product->color = $request->color;
        $product->fit = $request->fit;

        $main_image = $request->main_image;

        $main_image_new_name = time() . $main_image->getClientOriginalName();

        $main_image->move('uploads/products/', $main_image_new_name);

        $product->main_image = 'uploads/products/' . $main_image_new_name;

        $image_gallery=array();
        if ($request->hasfile('image_gallery')) {
            foreach ($request->file('image_gallery') as $file) {
                $name= time() . $file->getClientOriginalName();

                $file->move('uploads/products/', $name);
                $image_gallery[]= 'uploads/products/' . $name;
            }

            $product->image_gallery = serialize($image_gallery);
        }

        if ($product->save()) {
            return response([
                'data' => new ProductResource($product),
                'message' => 'success'
            ]);
        }
    }
    public function addVariation($productId, ProductVariationRequest $request)
    {
        $product = Product::find($productId);
        $product_variation = new ProductVariation;
        $product_variation->name = $request->name;
        $product_variation->price = $request->price;
        $product_variation->type_id = 1;
        $product->variations()->save($product_variation);
        $stock = new Stock;
        $stock->quantity = $request->stock_count;
        $product_variation->stocks()->save($stock);

        return response([
            'data' => new ProductResource($product),
            'message' => 'success'
        ]);
    }
    public function show($product_slug)
    {
        $product = Product::where('slug', '=', $product_slug)->firstOrFail();

        $product->load(['variations.type', 'variations.stock', 'variations.product']);

        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        $product = Product::find($id);
        $product->product_code = $request->product_code;
        $product->name = $request->name;
        $product->slug = Str::slug($request->slug);
        $product->description = $request->description;
        $product->price = $request->price;
        $product->featured = $request->featured;
        $product->occasion = $request->occasion;
        $product->brand_id = $request->brand_id;
        $product->gender = $request->gender;
        $product->sleeve = $request->sleeve;
        $product->neck = $request->neck;
        $product->color = $request->color;
        $product->fit = $request->fit;

        if ($product->save()) {
            return response([
                'data' => new ProductResource($product),
                'message' => 'success'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'data' => 'deleted',
        ], 200);
    }

    public function updateMainImage($id, ProductMainImageRequest $request)
    {
        $product = Product::find($id);
        $old_image_path = $product->main_image;
        if (File::exists($old_image_path)) {
            File::delete($old_image_path);
            $main_image = $request->main_image;

            $main_image_new_name = time() . $main_image->getClientOriginalName();

            $main_image->move('uploads/products/', $main_image_new_name);

            $product->main_image = 'uploads/products/' . $main_image_new_name;

            if ($product->save()) {
                return response([
                    'message' => 'success',
                    'main_image_path' => $product->main_image
                ], 200);
            }
        }
    }

    public function addToImageGallery($id, ProductImageGalleryRequest $request)
    {
        $product = Product::find($id);
        $image_gallery = unserialize($product->image_gallery);

        if ($request->hasfile('image_gallery')) {
            foreach ($request->file('image_gallery') as $file) {
                $name= time() . $file->getClientOriginalName();

                $file->move('uploads/products/', $name);
                $image_gallery[]= 'uploads/products/' . $name;
            }

            $product->image_gallery = serialize($image_gallery);

            if ($product->save()) {
                return response([
                    'image_gallery_path' => $image_gallery,
                    'message' => 'success'
                ]);
            }
        }
    }

    public function deleteImageFromImageGallery($id, $key)
    {
        $product = Product::find($id);
        $image_gallery = unserialize($product->image_gallery);
        $image_path = $image_gallery[$key];

        if (File::exists($image_path)) {
            File::delete($image_path);
            unset($image_gallery[$key]);
            $product->image_gallery = serialize(array_values($image_gallery));
            if ($product->save()) {
                return response([
                    'image_gallery_path' => unserialize($product->image_gallery),
                    'message' => 'success'
                ], 200);
            }
        }
    }

    public function deleteVariation($id, $productId)
    {
        $product = Product::find($productId);
        $product_variation = ProductVariation::find($id);
        $product_variation->delete();

        return response([
            'data' => new ProductResource($product),
            'message' => 'success'
        ], 200);
    }

    public function updateVariation($id, $productId, ProductUpdateVariationRequest $request)
    {
        $product = Product::find($productId);

        $product_variation = ProductVariation::find($id);
        $product_variation->name = $request->name;
        $product_variation->price = $request->price;
        $product_variation->save();

        $stock = Stock::where('product_variation_id', $id);
        $stock->update(['quantity' => $request->stock_count]);

        return response([
            'data' => new ProductResource($product),
            'message' => 'success'
        ], 200);
    }
}