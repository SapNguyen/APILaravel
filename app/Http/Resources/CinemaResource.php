<?php

namespace App\Http\Resources;

use App\Models\Seat;
use Illuminate\Http\Resources\Json\JsonResource;

class CinemaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $seats = Seat::where('idphong',$this->idphong)->get();
        foreach($seats as $seat){
            $seat->showId = $this->showId;
        }
        return [
            "id" => $this->idphong,
            "name" => $this->name,
            "amount_of_seat" => $this->amount_of_seat,
            "seat_per_row" => $this->seat_per_row,
            "seats" => new SeatCollection($seats)
        ];
    }
}
