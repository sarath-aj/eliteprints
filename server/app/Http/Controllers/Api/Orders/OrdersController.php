<?php

namespace App\Http\Controllers\Api\Orders;

use App\Cart\Cart;
use App\Events\Order\OrderCreated;
use App\Http\Requests\Order\OrderStoreRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Order\OrderResource;
use App\Http\Resources\Order\OrderSingleResource;
use Illuminate\Http\Request;
use App\Models\Order;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api']);
        $this->middleware(['cart.sync', 'cart.notEmpty'])->only('store');
    }

    public function index(Request $request)
    {
        $orders = $request->user()->orders()
            ->with([
                'products.product.variations.stock',
                'products.type',
                'products.stock',
                'address',
                'shippingMethod'
            ])
            ->latest()
            ->paginate(10);

        return OrderResource::collection($orders);
    }

    public function store(OrderStoreRequest $request, Cart $cart)
    {
        $order = $this->createOrder($request, $cart);
        $order->products()->sync($cart->products()->forSyncing());

        event(new OrderCreated($order));

        return new OrderResource($order);
    }

    protected function createOrder(OrderStoreRequest $request, Cart $cart)
    {
        return $request->user()->orders()->create(
            array_merge($request->only(['address_id', 'shipping_method_id', 'payment_method_id']), [
                'subtotal' => $cart->subtotal()->amount()
            ])
        );
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'status' => 'required',
        ]);


        $order = Order::findOrFail($id);
        $order->update($request->only('status'));

        return response()->json(
            [
            'data' => [
                'message' => 'success',
            ]
         ]
        );
    }

    public function show($order)
    {
        $order = Order::findOrFail($order);
        $order->load([
                'products.product.variations.stock',
                'products.type',
                'products.stock',
                'address',
                'shippingMethod'
            ]);

        return new OrderSingleResource($order);
    }
}