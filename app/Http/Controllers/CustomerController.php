<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Inertia\Inertia;

class CustomerController extends Controller
{
    // Display all customers.
    public function index()
    {
        $customers = \App\Models\Customer::all();

        return Inertia::render('Customers/Index', [
            'customers' => Customer::all(),
        ]);
    }
}
