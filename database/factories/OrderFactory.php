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
            'billing_address' => $this->faker->address,
            'credit_card_last_four' => $this->faker->numerify('####'),
            'credit_card_type' => $this->faker->creditCardType,
            'customer_id' => Customer::inRandomOrder()->first()->id,
            'customer_note' => $this->faker->sentence,
            'shipping_address' => $this->faker->address,
            'status' => $this->faker->randomElement(['pending', 'completed', 'shipped']),
        ];
    }
}
