<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display all products.
     */
    public function index()
    {
        return Inertia::render('Products/Index', [
            'products' => Product::all(),
        ]);
    }

    /**
     * Show a single product.
     */
    public function show(Product $product)
    {
        return Inertia::render('Products/{product}/Show')->with([
            'product' => $product,
        ]);
    }

    /**
     * Edit a single product.
     */
    public function edit(Product $product)
    {

        return Inertia::render('Products/{product}/Edit')->with([
            'product' => $product,
        ]);
    }

    /**
     * Create a new product.
     */
    public function create()
    {
        return Inertia::render('Products/Create');
    }

    /**
     * Save a new product.
     */
    public function store(ProductStoreRequest $request)
    {
        $productData = $request->validated();

        $request->user()->products()->create($productData);

        return redirect()->route('products.index');
    }

    /**
     * Update a product.
     */
    public function update(ProductStoreRequest $request, Product $product)
    {
        $productData = $request->validated();

        $product->update($productData);

        return Inertia::render('Products/{product}/Edit', [
            'product' => $product->refresh(),
        ]);
    }

    /**
     * Delete a product.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index');
    }
}
