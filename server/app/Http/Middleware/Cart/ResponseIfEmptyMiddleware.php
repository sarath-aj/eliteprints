<?php

namespace App\Http\Middleware\Cart;

use App\Cart\Cart;
use Closure;
use Illuminate\Http\Response;

class ResponseIfEmptyMiddleware
{
    /**
     * @var Cart
     */
    private $cart;

    /**
     * SyncMiddleware constructor.
     *
     * @param Cart $cart
     */
    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->cart->isEmpty()) {
            return response()->json([
                'message' => 'Cart is empty'
            ], Response::HTTP_BAD_REQUEST);
        }

        return $next($request);
    }
}
