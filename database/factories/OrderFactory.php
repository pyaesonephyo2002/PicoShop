<?php

namespace Database\Factories;

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
            'voucher_no' => $this->faker->unique()->ean8,
            'total' => $this->faker->numberBetween(1000, 50000),
            'qty' => $this->faker->numberBetween(1, 100),
            'payment_slip' => $this->faker->imageUrl(),
            'status' => $this->faker->randomElement(['pending', 'completed', 'cancelled']),
            'note' => $this->faker->sentence,
            'item_id' => rand(1, 50), 
            'payment_id' => rand(1, 10), 
            'user_id' => rand(1, 1), 
        ];
    }
}
