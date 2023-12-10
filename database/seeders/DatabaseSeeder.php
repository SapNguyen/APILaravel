<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call(UserSeeder::class);
        $this->call(PromotionSeeder::class);
        $this->call(CinemaSeeder::class);
        $this->call(FilmSeeder::class);
        $this->call(SeatSeeder::class);
        $this->call(ShowSeeder::class);
        $this->call(TicketSeeder::class);

    }
}
