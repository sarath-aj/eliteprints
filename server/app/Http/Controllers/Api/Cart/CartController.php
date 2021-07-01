<?php

namespace App\Http\Controllers\Api\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Cart\CartStoreRequest;
use App\Http\Requests\Cart\CartUpdateRequest;
use App\Http\Resources\Cart\CartResource;
use App\Models\Cart;
use App\Models\ProductVariation;
use Illuminate\Http\Response;
use App\Models\ShippingMethod;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Cart $cart)
    {
        $cart->sync();

        $request->user()->load(['cart.product.variations.stock', 'cart.stock', 'cart.type']);

        return (new CartResource($request->user()))
            ->additional([
                'meta' => $this->meta($cart, $request),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CartStoreRequest $request, Cart $cart)
    {
        $cart->add($request->get('products'));

        return response()->json([], Response::HTTP_CREATED);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductVariation $productVariation, CartUpdateRequest $request, Cart $cart)
    {
        $cart->update($productVariation->id, $request->get('quantity'));

        return response()->json([], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductVariation $productVariation, Cart $cart)
    {
        $cart->delete($productVariation->id);
    }

    private function meta(Cart $cart, Request $request): array
    {
        $shipping = $request->has('shipping_method_id')
            ? ShippingMethod::find($request->get('shipping_method_id'))
            : null;

        return [
            'empty' => $cart->isEmpty(),
            // 'subtotal' => $cart->subtotal()->formatted(),
            'subtotal' => $cart->subtotalUnformatted(),
            // 'total' => $cart->withShipping($shipping)->total()->formatted(),
            'total' => $cart->withShipping($shipping)->totalUnformatted(),
            'changed' => $cart->hasChanged(),
        ];
    }
}
