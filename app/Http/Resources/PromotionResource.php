<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PromotionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->idkm,
            'code' => $this->code,
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->image,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'discount' => $this->discount
        ];
    }
}
