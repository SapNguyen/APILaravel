<?php

namespace App\Http\Resources;

use App\Models\SeatStatus;
use Illuminate\Http\Resources\Json\JsonResource;

class SeatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    
    public function toArray($request)
    {
        $isSelected = 0;
        $isBooked = 0;

        if(!isset($this->showId)) return;
        $seatStatus = SeatStatus::where('idghe', $this->idghe)
            ->where('idshow', $this->showId)
            ->get();
        
        if(count($seatStatus) > 0){
            $isSelected = $seatStatus[0]->isSelected;
            $isBooked = $seatStatus[0]->isBooked;
        }
        return [
            "id" => $this->idghe,
            "name" => $this->row . $this->column,
            "isSelected" => $isSelected,
            "isBooked" => $isBooked
        ];
    }
}
