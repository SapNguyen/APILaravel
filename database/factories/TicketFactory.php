<?php

namespace Database\Factories;

use App\Models\Seat;
use App\Models\SeatStatus;
use App\Models\Show;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Ticket;
use App\Models\User;

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
        $seats = Seat::all();
        $shows = Show::all();
        $users = User::all();
        $valid = false;
        $idghe = null;
        $idshow = null;
        while (!$valid) {
            $idghe = $seats->random()->idghe;
            $seat = Seat::find($idghe);
            $idshow = $shows->random()->idshow;
            $ticket = Ticket::where('idghe', $idghe)
                ->where('idshow', $idshow)
                ->get();
            if(count($ticket) == 0){
                $valid = true;
                $seatStatus = new SeatStatus();
                $seatStatus->isBooked = 1;
                $seatStatus->isSelected = 0;
                $seatStatus->idshow = $idshow;
                $seatStatus->idghe = $idghe;
                $seatStatus->save();
            }
        }
        return [
            'idghe' => $idghe,
            'idshow' => $idshow,
            'idtk' => $users->random()->idtk,
            'seat' => $seat[0]->row . $seat[0]->column,
            'cost' => fake()->randomFloat(0, 100000, 200000),
            'deleted' => 0
        ];
    }
}
