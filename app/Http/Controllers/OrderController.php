<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $orders = Order::with(['customer', 'items'])->paginate(10);

        return Inertia::render('Orders/Index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Orders/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderStoreRequest $request): RedirectResponse
    {
        $orderData = $request->validated();

        $order = Order::create($orderData);

        foreach ($request->products as $product) {
            $order->items()->create([
                'product_id' => $product['product_id'],
                'quantity' => $product['quantity'],
                'price' => Product::find($product['product_id'])->price,
            ]);
        }

        return redirect()->route('orders.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order): Response
    {
        $order->load(['customer', 'items.product']);

        return Inertia::render('Orders/{order}/Show')->with([
            'order' => $order,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order): RedirectResponse
    {
        $order->delete();

        return redirect()->route('orders.index');
    }
}
