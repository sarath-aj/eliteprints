<?php

namespace App\Http\Controllers\Api\Reports;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use Carbon\Carbon;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reports()
    {
        return response()->json([
            'data' => [
                'total_products' => $this->totalProducts(),
                'total_customers' => $this->totalCustomers(),
                'orders_today' => $this->ordersToday(),
                'pending_orders' => $this->pendingOrders(),
            ]
        ]);
    }

    public function totalProducts()
    {
        $products = Product::all()->count();

        return ($products) ? ($products) : 0;
    }

    public function totalCustomers()
    {
        $user = User::where('is_admin', '=', '0')->count();

        return ($user) ? ($user) : 0;
    }

    public function ordersToday()
    {
        $orders = Order::whereDate('created_at', Carbon::today())->count();

        return ($orders) ? ($orders) : 0;
    }

    public function pendingOrders()
    {
        $orders = Order::where('status', '=', 'processing')->count();

        return ($orders) ? ($orders) : 0;
    }
}