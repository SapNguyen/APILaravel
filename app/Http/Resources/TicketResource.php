<?php

namespace App\Http\Resources;

use App\Models\Seat;
use App\Models\Show;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $user = User::find($this->idtk);
        $seatIds = explode(",",$this->idghe);
        $seatNames = [];
        foreach ($seatIds as $seatId) {
            $seat = Seat::find($seatId);
            array_push($seatNames, $seat->row.$seat->column);
        }
        $show = Show::find($this->idshow);
        return [
            "id" => $this->idve,
            "user" => new UserResource($user),
            "seat" => implode(", ",$seatNames),
            "show" => new ShowResource($show),
            "cost" => number_format($this->cost)
        ];
    }
}
