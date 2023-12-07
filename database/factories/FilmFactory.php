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
            'image' => 'images/example.jpg',
            'release' => fake()->date(),
            'time' => fake()->time(),
            'censor' => fake()->randomElement(["P","16+","18+","13+"]),
            'category' => fake()->randomElement(['Hành động', 'Phiêu lưu', "Hoạt hình","Trinh thám"]),
            'author' => fake()->name(),
            'actor' => fake()->name(),
            'language' => fake()->randomElement(["Tiếng Anh","Tiếng Việt"]),
        ];
    }
}
