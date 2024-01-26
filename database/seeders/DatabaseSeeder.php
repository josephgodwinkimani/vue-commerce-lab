<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Create a test user.
        User::factory()->create([
            'name' => 'Jane Doe',
            'email' => 'admin@vuecommercelab.com',

        ]);

        // Seed 500 products.
        Product::factory(500)->create();

        // Seed 500 customers.
        Customer::factory(500)->create();

        // Seed 500 orders with each order having multiple order items.
        Order::factory(500)->create()->each(function ($order) {
            OrderItem::factory(rand(1, 5))->create([
                'order_id' => $order->id,
            ]);
        });
    }
}
