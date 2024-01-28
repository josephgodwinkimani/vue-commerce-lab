<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $orders = Order::with(['customer', 'items.product'])->paginate(10);

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
        return DB::transaction(function () use ($request) {
            // Validate the request data.
            $orderData = $request->validated();

            // Create a new order from the validated data.
            $order = Order::create($orderData);

            // Retrieve all product IDs from the request.
            $productIds = array_column($request->products, 'product_id');

            // Fetch all products in one query and key them by their IDs.
            $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

            // Iterate over each product from the request.
            foreach ($request->products as $product) {
                // Create a new order item for each product.
                $order->items()->create([
                    'product_id' => $product['product_id'], // Set the product ID.
                    'quantity' => $product['quantity'],     // Set the quantity.
                    'price' => $products[$product['product_id']]->price, // Retrieve the price from pre-fetched products.
                ]);
            }

            // Redirect to the orders index route after successful creation.
            return redirect()->route('orders.index');
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order): Response
    {
        $order->load(['customer', 'items.product']);

        return Inertia::render('Orders/{order}/Show', [
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
