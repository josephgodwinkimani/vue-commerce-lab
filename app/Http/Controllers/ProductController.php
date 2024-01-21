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
    public function all()
    {
        return Inertia::render('Products/All', [
            'products' => Product::all(),
        ]);
    }

    /**
     * View a single product.
     */
    public function view(Product $product)
    {
        return Inertia::render('Products/{product}/View')->with([
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

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/products', 'public');
            $productData['image'] = $path;
        }

        $request->user()->products()->create($productData);

        return redirect()->route('products.index');
    }

    /**
     * Update a product.
     */
    public function update(ProductStoreRequest $request, Product $product)
    {
        $product->update($request->validated());

        return redirect()->route('products.index');
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
