<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerStoreRequest;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $customers = Customer::withCount('orders')->paginate(10);

        return Inertia::render('Customers/Index', ['customers' => $customers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerStoreRequest $request): RedirectResponse
    {
        return DB::transaction(function () use ($request) {

            // Validate the request data.
            $customerData = $request->validated();

            // Create a new customer from the validated data.
            Customer::create($customerData);

            // Redirect the user back to the index page.
            return redirect()->route('customers.index');
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer): Response
    {
        $customer->load('orders');

        return Inertia::render('Customers/{customer}/Show', [
            'customer' => $customer,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer): RedirectResponse
    {
        $customer->delete();

        return redirect()->route('customers.index');
    }
}
