<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Ticket;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Ticket::class;

    public function definition()
    {
        return [
            'idshow' => '1',
            'idtk' => '1',
            'date_create' => fake()->date(),
            'seat' => Str::rand(3),
            'cost' => fake()->digit(),
        ];
    }
}
