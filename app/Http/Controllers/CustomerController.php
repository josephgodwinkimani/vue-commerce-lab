<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerStoreRequest;
use App\Models\Customer;
use Inertia\Inertia;

class CustomerController extends Controller
{
    /**
     * Display all customers.
     */
    public function index()
    {
        return Inertia::render('Customers/Index', [
            'customers' => Customer::all(),
        ]);
    }

    /**
     * Show a single customer.
     */
    public function show(Customer $customer)
    {
        return Inertia::render('Customers/{customer}/Show', [
            'customer' => $customer,
        ]);
    }

    /**
     * Edit a single customer.
     */
    public function edit(Customer $customer)
    {

        return Inertia::render('Customers/{customer}/Edit')->with([
            'customer' => $customer,
        ]);
    }

    /**
     * Create a new customer.
     */
    public function create()
    {
        return Inertia::render('Customers/Create');
    }

    /**
     * Save a new customer.
     */
    public function store(CustomerStoreRequest $request)
    {
        $customerData = $request->validated();

        $request->user()->customer()->create($customerData);

        return redirect()->route('customers.index');
    }

    /**
     * Update a customer.
     */
    public function update(CustomerStoreRequest $request, Customer $customer)
    {
        $customerData = $request->validated();

        $customer->update($customerData);

        return Inertia::render('Customers/{customer}/Edit', [
            'customer' => $customer->refresh(),
        ]);
    }

    /**
     * Delete a customer.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index');
    }
}
