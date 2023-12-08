<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Promotion;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Promotion>
 */
class PromotionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Promotion::class;

    public function definition()
    {
        return [
            'code' => strtoupper(fake()->unique()->bothify('??????##')),
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'image' => fake()->imageUrl(),
            'startDate' => fake()->dateTimeBetween('-1 month', '+1 month'),
            'endDate' => fake()->dateTimeBetween('+2 days', '+2 months'),
            'discount' => fake()->randomElement([30,40,50])
        ];
    }
}
