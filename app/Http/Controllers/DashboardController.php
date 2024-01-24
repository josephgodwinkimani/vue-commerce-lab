<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with the required data.
     */
    public function index()
    {
        $ordersCount = Order::countRecentOrders();

        return Inertia::render('Dashboard/Index', [
            'ordersCount' => $ordersCount,
        ]);
    }
}
