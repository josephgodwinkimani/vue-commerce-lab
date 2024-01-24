<?php

use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test accessing the customers route without authentication.
     */
    public function test_access_customers_route_without_authentication(): void
    {

        // Access the customers route.
        $response = $this->get('/customers');

        // Assert that the user is redirected back to the login page.
        $response->assertRedirect('/login');
    }

    /**
     * Test accessing the customers route with authentication.
     */
    public function test_access_customers_route_with_authentication(): void
    {
        // Create a user and log in.
        $user = User::factory()->create();

        // Log the user in.
        $this->actingAs($user);

        // Access the customers route.
        $response = $this->get('/customers');

        // Assert successful response code.
        $response->assertStatus(200);
    }

    /**
     * Test creating a new customer.
     */
    public function test_customer_creation(): void
    {
        // Create and log in a user if authentication is required.
        $user = User::factory()->create();
        $this->actingAs($user);

        // Generate customer data using CustomerFactory.
        $customerData = Customer::factory()->make()->toArray();

        // Send POST request to create a new customer.
        $response = $this->post('/customers', $customerData);

        // Assert that the response is a redirect to the customers index route.
        $response->assertRedirect(route('customers.index'));

        // Assert the customer was created in the database.
        $this->assertDatabaseHas('customers', [
            'email' => $customerData['email'],
        ]);
    }

    /**
     * Test customer deletion.
     */
    public function test_customer_delete(): void
    {
        // Create and log in a user if authentication is required.
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create a customer.
        $customer = Customer::factory()->create();

        // Send DELETE request to delete the customer.
        $response = $this->delete("/customers/{$customer->id}");

        // Assert that the response is a redirect to the customers index route.
        $response->assertRedirect(route('customers.index'));

        // Assert the customer is deleted from the database.
        $this->assertDatabaseMissing('customers', ['id' => $customer->id]);
    }
}
