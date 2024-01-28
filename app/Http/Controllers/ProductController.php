<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
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
        return DB::transaction(function () use ($request) {

            // Validate the request data.
            $productData = $request->validated();

            // Create a new product from the validated data.
            Product::create($productData);

            // Redirect the user back to the index page.
            return redirect()->route('products.index');
        });
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
