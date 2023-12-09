<?php

namespace App\Http\Resources;

use App\Models\Show;
use Carbon\Carbon;
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
            "description" => $this->description,
            "release_date" => $this->release_date,
            "runtime" => $this->runtime,
            "age_validation" => $this->age_validation,
            "genre" => $this->genre,
            "director" => $this->director,
            "actor" => $this->actor,
            "language" => $this->language,
            "shows" => $this->whenNotNull($this->shows)
        ];
    }
}
