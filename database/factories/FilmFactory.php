<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Film;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Film>
 */
class FilmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Film::class;

    public function definition()
    {
        return [
            'name' => fake()->unique()->name(),
            'image' => fake()->imageUrl(),
            'release_date' => fake()->dateTimeBetween('-10 day', '+20 day'),
            'end_date' => fake()->dateTimeBetween('+1 month', '+2 month'),
            'description' => fake()->paragraph(),
            'runtime' => fake()->numberBetween(60, 180),
            'age_validation' => fake()->randomElement(["P","16+","18+","13+"]),
            'genre' => fake()->randomElement(['Hành động', 'Phiêu lưu', "Hoạt hình","Trinh thám"]),
            'director' => fake()->name(),
            'actor' => fake()->name(),
            'language' => fake()->randomElement(["Tiếng Anh","Tiếng Việt"]),
            'deleted' => 0
        ];
    }
}
