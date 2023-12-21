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
        $seat = Seat::find($this->idghe);
        $seatNames = $seat->row . $seat->column;
        if($this->seat != null){
            $seatNames = $this->seat;
        }
        $show = Show::find($this->idshow);
        return [
            "id" => $this->idve,
            "user" => new UserResource($user),
            "seat" => $seatNames,
            "show" => new ShowResource($show),
            "cost" => number_format($this->cost)
        ];
    }
}
