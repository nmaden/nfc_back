<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OfficeResource extends JsonResource
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
            'id'=>$this->id,
            'name'=>$this->name,
            'area'=>$this->attributes->area,
            'city'=>$this->attributes->city,
            'wifi'=>$this->attributes->wifi,
            'tv'=>$this->attributes->tv,
            'coffee_machine'=>$this->attributes->coffee_machine,
            'count_seats'=>$this->attributes->count_seats,
            'comments'=>$this->comments
        ];
    }
}
