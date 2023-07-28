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
            'id'=> $this->id,
            'name_ru' => $this->getTranslation('name', 'ru'),
            'name_en' => $this->getTranslation('name', 'en'),
            'services'=> $this->services,
            'comments'=>$this->comments
        ];
    }
}
