<?php

namespace Database\Factories;

use App\Models\Cinema;
use App\Models\Film;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Show>
 */
class ShowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $idphongs = Cinema::pluck('idphong')->toArray();
        $idphims = Film::pluck('idphim')->toArray();
        return [
            'start_time' => fake()->unique()->dateTimeBetween('+1 day', '+3 week'),
            'idphim' => fake()->randomElement($idphims),
            'idphong' => fake()->randomElement($idphongs)
        ];
    }
}
