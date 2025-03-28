<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'quality' => fake()->name(),
            'resolution' => fake()->name(),
            'popular' => fake()->boolean(),
            'period' => fake()->randomNumber(2),
            'price' => fake()->randomNumber(3),
            'discount' => fake()->randomFloat(3, 0, 1),
        ];
    }
}
