<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with the required data.
     */
    public function index()
    {
        $ordersCount = Order::countRecentOrders();
        $totalRecentOrdersAmount = Order::sumRecentOrdersAmount();
        $topCustomers = Customer::topCustomers();
        $topSellingProducts = Product::topSellingProducts();

        return Inertia::render('Dashboard/Index', [
            'ordersCount' => $ordersCount,
            'totalRecentOrdersAmount' => $totalRecentOrdersAmount,
            'topCustomers' => $topCustomers,
            'topSellingProducts' => $topSellingProducts,
        ]);
    }
}
