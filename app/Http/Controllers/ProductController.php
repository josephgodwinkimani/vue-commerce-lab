<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $products = Product::paginate(10);

        return Inertia::render('Products/Index', ['products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request): RedirectResponse
    {
        $productData = $request->validated();

        Product::create($productData);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): Response
    {
        $totalSalesLastWeek = $product->totalSalesInPeriod();

        return Inertia::render('Products/{product}/Show', [
            'product' => $product,
            'totalSalesLastWeek' => $totalSalesLastWeek,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('products.index');
    }
}
