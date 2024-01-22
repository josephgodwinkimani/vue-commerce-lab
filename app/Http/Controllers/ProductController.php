<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Product image upload path.
     */
    private $imagePath = 'images/products';

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
     * Add a new product.
     */
    public function add()
    {
        return Inertia::render('Products/Add');
    }

    /**
     * Save a new product.
     */
    public function store(ProductStoreRequest $request)
    {
        $productData = $request->validated();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store($this->imagePath, 'public');
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
        $productData = $request->validated();

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $path = $request->file('image')->store($this->imagePath, 'public');
            $productData['image'] = $path;
        }

        $product->update($productData);

        return Inertia::render('Products/{product}/Edit', [
            'product' => $product->refresh(),
        ]);
    }

    /**
     * Delete an image.
     */
    public function deleteImage(Product $product)
    {

        $imagePath = $product->image;

        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }

        $product->update([
            'image' => null,
        ]);

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
