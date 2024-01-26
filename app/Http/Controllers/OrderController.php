<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Models\Order;
use App\Models\Product;
use Inertia\Inertia;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with(['customer', 'product'])->paginate(10);

        return Inertia::render('Orders/Index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Orders/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderStoreRequest $request)
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
    public function show(Order $order)
    {
        $order = Order::with(['customer', 'product'])->findOrFail($order->id);

        return Inertia::render('Orders/{order}/Show')->with([
            'order' => $order,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {

        return Inertia::render('Orders/{order}/Edit')->with([
            'order' => $order,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderStoreRequest $request, Order $order)
    {
        $orderData = $request->validated();

        $order->update($orderData);

        // Remove all existing items and add new ones.
        $order->items()->delete();
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
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index');
    }
}
