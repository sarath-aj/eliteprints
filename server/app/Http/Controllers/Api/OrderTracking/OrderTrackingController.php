<?php

namespace App\Http\Controllers\Api\OrderTracking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Order\OrderTrackRequest;
use App\Models\User;

class OrderTrackingController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['auth:api']);
    }

    public function trackOrder(OrderTrackRequest $request)
    {
        $user = User::where('email', $request->email) -> first();
        if (!$user) {
            return response()->json(
                [
                'data' => [
                    'status' => 'Order Not Found',
                ]
             ]
            );
        }

        if (!$user->orders()->where('id', $request->orderId)->first()) {
            return response()->json(
                [
                'data' => [
                    'status' => 'Order Not Found',
                ]
             ]
            );
        }

        return response()->json(
            [
            'data' => [
                'status' => 'Your Order Status Is ' . $user->orders()->where('id', $request->orderId)->first()->status,
            ]
            ]
        );
    }
}
