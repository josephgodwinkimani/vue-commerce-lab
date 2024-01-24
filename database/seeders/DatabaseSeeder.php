<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Create a test user.
        \App\Models\User::factory()->create([
            'name' => 'Jane Doe',
            'email' => 'admin@vuecommercelab.com',

        ]);

        // Seed 500 products.
        \App\Models\Product::factory(500)->create();

        // Seed 500 customers.
        \App\Models\Customer::factory(500)->create();

        // Seed 500 orders.
        \App\Models\Order::factory(500)->create();
    }
}
