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
    public function test_access_products_route_without_authentication(): void
    {

        // Access the products route.
        $response = $this->get('/products');

        // Assert that the user is redirected back to the login page.
        $response->assertRedirect('/login');
    }

    /**
     * Test accessing the products route with authentication.
     */
    public function test_access_products_route_with_authentication(): void
    {
        // Create a user.
        $user = User::factory()->create();

        // Authenticate as the user.
        $this->actingAs($user);

        // Access the products route.
        $response = $this->get('/products');

        // Assert successful response code.
        $response->assertStatus(200);
    }

    /**
     * Test product creation.
     */
    public function test_product_creation(): void
    {
        // Create a user.
        $user = User::factory()->create();

        // Authenticate as the user.
        $this->actingAs($user);

        // Generate product data.
        $product = Product::factory()->make()->toArray();

        // Send POST request to create a new product.
        $response = $this->post('/products', $product);

        // Assert that the response has a 302 status code (redirect).
        $response->assertRedirect(route('products.index'));

        // Assert the product was created in the database.
        $this->assertDatabaseHas('products', [
            'name' => $product['name'],
        ]);
    }

    /**
     * Test product deletion.
     */
    public function test_product_delete(): void
    {

        // Create a user.
        $user = User::factory()->create();

        // Authenticate as the user.
        $this->actingAs($user);

        // Create a product.
        $product = Product::factory()->create();

        // Send DELETE request to delete the product.
        $response = $this->delete("/products/{$product->id}");

        // Assert that the response has a 302 status code (redirect).
        $response->assertRedirect(route('products.index'));

        // Assert that the product was deleted from the database.
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

    /**
     * Test inventory adjustment on product sale.
     */
    public function test_inventory_adjustment_on_sale(): void
    {

        // Create a user.
        $user = User::factory()->create();

        // Authenticate as the user.
        $this->actingAs($user);

        // Create a product with a known quantity count.
        $product = Product::factory()->create(['quantity' => 10]);

        // Simulate a sale of 3 units.
        $product->adjustInventoryOnSale(3);

        // Check if the inventory count is reduced by 3.
        $this->assertEquals(7, $product->fresh()->quantity);
    }
}
