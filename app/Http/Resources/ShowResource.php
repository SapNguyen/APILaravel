<?php

namespace App\Http\Resources;

use App\Models\Cinema;
use App\Models\Film;
use DateTime;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $cinema = Cinema::where('idphong', $this->idphong)->get();
        $film = Film::where('idphim', $this->idphim)->get();
        $start_time = DateTime::createFromFormat('Y-m-d H:i:s', $this->start_time);
        $format = 'd/m H:i';
        $parts = explode(' ', $start_time->format($format));

        return [
            'id' => $this->idshow,
            'cinema' => $cinema[0],  
            // 'film' => new FilmResource($film[0]),  
            'date' =>  $parts[0],
            'time' => $parts[1]
        ];
    }
}
