<?php

namespace Database\Factories;

use App\Models\Cinema;
use App\Models\Film;
use App\Models\Show;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

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
        $film = Film::where('deleted','0')
            ->get()->random();
        $idphim = $film->idphim;
        $idphong = Cinema::where('deleted','0')->get()->random()
            ->idphong;
        $release_date = Carbon::parse($film->release_date);
        //ngày chiếu từ 2 ngày trước - 1 tháng sau ngày ra mắt phim
        $date_start = $release_date->copy()->subDays(2)
            ->addDays(rand(0, 20))
            ->format('Y-m-d');
        while (True) {
            $rangeDate = [
                $date_start." 00:00:00",
                $date_start." 23:59:59"
            ];
            //giờ chiếu
            $shows = Show::where('deleted','0')
                // ->where('idphong',$idphong)
                ->whereBetween('start_time', $rangeDate)
                ->get();

            $time = null;
            if(count($shows) > 0){
                $prev_show = $shows[count($shows)-1];
                $prev_film = Film::where('idphim',$prev_show->idphim)
                    ->get();
                $next_datetime = Carbon::parse($prev_show->start_time)
                    ->addMinutes(10 + $prev_film[0]->runtime);
                $limit_time = Carbon::parse($date_start." 23:59:59");
                if($next_datetime->greaterThan($limit_time)){
                    $date_start = $next_datetime->format('Y-m-d');
                    continue;
                }else{
                    $time = $next_datetime->format('H:i:s');
                }

            }else{
                $time = '08:00:00';
            }
            $start_time = $date_start." ".$time;
            return [
                'start_time' => $start_time,
                'idphim' => $idphim,
                'idphong' => $idphong,
                'deleted' => 0
            ];
        }
    }
}
