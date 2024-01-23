<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::inRandomOrder()->first()->id,
            'product_id' => Product::inRandomOrder()->first()->id,
            'status' => $this->faker->randomElement(['pending', 'completed', 'shipped']),
            'shipping_address' => $this->faker->address,
            'billing_address' => $this->faker->address,
            'credit_card_type' => $this->faker->creditCardType,
            'credit_card_last_four' => $this->faker->numerify('####'),
            'customer_note' => $this->faker->sentence,
            'quantity' => $this->faker->numberBetween(1, 10),
            'total_amount' => $this->faker->randomFloat(2, 1, 1000),
        ];
    }
}
