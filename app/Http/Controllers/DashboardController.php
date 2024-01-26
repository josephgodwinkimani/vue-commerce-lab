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
        $ordersCount = Order::countRecentOrders(7);
        $totalRecentOrdersAmount = Order::sumRecentOrdersAmount(7);
        $bestCustomers = Customer::bestCustomers(7, 3);
        $bestSellingProducts = Product::bestSellingProducts(7, 3)->get();

        return Inertia::render('Dashboard/Index', [
            'ordersCount' => $ordersCount,
            'totalRecentOrdersAmount' => $totalRecentOrdersAmount,
            'bestCustomers' => $bestCustomers,
            'bestSellingProducts' => $bestSellingProducts,
        ]);
    }

    /**
     * Display the best sellers page.
     */
    public function bestSellers()
    {

        $bestSellingProducts = Product::bestSellingProducts(7, 3)->get();

        return Inertia::render('Dashboard/Reports/BestSellers', [
            'bestSellingProducts' => $bestSellingProducts,
        ]);
    }

    /**
     * Display the best customers page.
     */
    public function bestCustomers()
    {

        $bestCustomers = Customer::bestCustomers(7, 10);

        return Inertia::render('Dashboard/Reports/BestCustomers', [
            'bestCustomers' => $bestCustomers,
        ]);
    }

    /**
     * Display the best customers page.
     */
    public function orderStatus()
    {
        $orders = Order::with(['customer', 'items'])->paginate(10);

        return Inertia::render('Dashboard/Reports/OrderStatus', ['orders' => $orders]);
    }
}
