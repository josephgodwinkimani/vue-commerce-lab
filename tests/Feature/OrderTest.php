<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test accessing the orders route without authentication.
     */
    public function test_access_orders_route_without_authentication()
    {

        // Access the orders route.
        $response = $this->get('/orders');

        // Assert that the user is redirected back to the login page.
        $response->assertRedirect('/login');
    }

    /**
     * Test accessing the orders route with authentication.
     */
    public function test_access_orders_route_with_authentication()
    {
        // Create a user and log in.
        $user = User::factory()->create();

        // Log the user in.
        $this->actingAs($user);

        // Access the orders route.
        $response = $this->get('/orders');

        // Assert successful response code.
        $response->assertStatus(200);
    }

    /**
     * Test creating a new customer.
     */
    public function test_order_creation()
    {
        // Create and log in a user if authentication is required.
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create a product for the foreign key dependency.
        $product = Product::factory()->create();

        // Create a customer for the foreign key dependency.
        $customer = Customer::factory()->create();

        // Generate order data using OrderFactory.
        $orderData = Order::factory()->make([
            'customer_id' => $customer->id,
            'product_id' => $product->id,
        ])->toArray();

        // Send POST request to create a new order.
        $response = $this->post('/orders', $orderData);

        // Assert that the response is a redirect to the orders index route.
        $response->assertRedirect(route('orders.index'));

        // Assert the order was created in the database.
        $this->assertDatabaseHas('orders', [
            'customer_id' => $customer->id,
            'product_id' => $product->id,
        ]);
    }

    /**
     * Test customer deletion.
     */
    public function test_order_delete()
    {
        // Create and log in a user if authentication is required.
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create a customer.
        $customer = Customer::factory()->create();

        // Send DELETE request to delete the customer.
        $response = $this->delete("/orders/{$customer->id}");

        // Assert that the response is a redirect to the orders index route.
        $response->assertRedirect(route('orders.index'));

        // Assert the customer is deleted from the database.
        $this->assertDatabaseMissing('orders', ['id' => $customer->id]);
    }
}
