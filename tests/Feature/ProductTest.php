<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test accessing the products route without authentication.
     */
    public function test_access_products_route_without_authentication()
    {
        $response = $this->get('/products');
        $response->assertRedirect('/login');
    }

    /**
     * Test accessing the products route with authentication.
     */
    public function test_access_products_route_with_authentication()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/products');
        $response->assertStatus(200);
    }

    /**
     * Test product creation.
     */
    public function test_product_creation()
    {
        // Create a user
        $user = User::factory()->create();

        // Authenticate as the user
        $this->actingAs($user);

        // Generate product data, making sure to include the user_id
        $productData = Product::factory()->make([
            'user_id' => $user->id, // Assign the user ID here
        ])->toArray();

        // Send POST request to create a new product
        $response = $this->post('/products', $productData);

        // Assert that the response has a 302 status code (redirect).
        $response->assertRedirect(route('products.index'));

        // Make sure 'sku' is part of the assertion
        $this->assertDatabaseHas('products', [
            'name' => $productData['name'],
            'sku' => $productData['sku'], // Include this in your assertion
        ]);
    }

    /**
     * Test product deletion.
     */
    public function test_product_delete()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $product = Product::factory()->create();
        $response = $this->delete("/products/{$product->id}");
        $response->assertRedirect(route('products.index'));

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
