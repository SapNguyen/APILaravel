<?php

namespace Database\Seeders;

use App\Models\Cinema;
use App\Models\Seat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cinemas = Cinema::all();
        foreach($cinemas as $cinema){
            $alphabet = array_map('chr', range(ord('A'), ord('Z')));
            $row = ceil($cinema->amount_of_seat / $cinema->seat_per_row);
            $count = 1;
            for ($i=0; $i < $row; $i++) { 
                $row_name = $alphabet[$i];
                for ($j=1; $j <= $cinema->seat_per_row; $j++) { 
                    if ($count > $cinema->amount_of_seat) break;
                    $seat = Seat::make([
                        'idphong' => $cinema->idphong,
                        'row' => $row_name,
                        'column' => $j,
                        'isSelected' => 0,
                        'isBooked' => rand(0, 1),
                    ]);
                    $seat->save();
                    $count++;
                }
            }
        }
    }
}
 