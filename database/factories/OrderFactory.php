<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Order::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::inRandomOrder()->first()->id,
            'status' => $this->faker->randomElement(['pending', 'completed', 'shipped']),
            'shipping_address' => $this->faker->address,
            'billing_address' => $this->faker->address,
            'credit_card_type' => $this->faker->creditCardType,
            'credit_card_last_four' => $this->faker->numerify('####'),
            'customer_note' => $this->faker->sentence,
            'total_amount' => $this->faker->randomFloat(2, 20, 500),
        ];
    }
}
