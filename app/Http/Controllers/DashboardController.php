<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Display the dashboard index route.
     */
    public function index(): Response
    {
        $ordersCount = Order::countRecentOrders(7);
        $totalRecentOrdersAmount = Order::calculateSumRecentOrdersAmount(7);
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
     * Display the best sellers route.
     */
    public function bestSellers(): Response
    {
        $bestSellingProducts = Product::bestSellingProducts(7, 3)->get();

        return Inertia::render('Dashboard/Reports/BestSellers', [
            'bestSellingProducts' => $bestSellingProducts,
        ]);
    }

    /**
     * Display the best customers route.
     */
    public function bestCustomers(): Response
    {
        $bestCustomers = Customer::bestCustomers(7, 10);

        return Inertia::render('Dashboard/Reports/BestCustomers', [
            'bestCustomers' => $bestCustomers,
        ]);
    }

    /**
     * Display the order status report.
     */
    public function orderStatus(): Response
    {
        $orderStatusCounts = Order::CountByStatus()->get();

        return Inertia::render('Dashboard/Reports/OrderStatus', ['orderStatusCounts' => $orderStatusCounts]);
    }
}
