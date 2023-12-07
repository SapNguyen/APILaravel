<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FilmResource extends JsonResource
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
            "id" => $this->idphim,
            "name" => $this->name,
            "image" => $this->image,
            "release" => $this->release,
            "time" => $this->time,
            "censor" => $this->censor,
            "category" => $this->category,
            "author" => $this->author,
            "actor" => $this->actor,
            "language" => $this->language
        ];
    }
}
