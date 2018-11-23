<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Game extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'logo' => asset('storage/img/games/'.$this->id.'/'.$this->logo),
            'img' => asset('storage/img/games/'.$this->id.'/'.$this->img),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
