<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Location extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $arrayData = [
            'city_id' => $this->city->id ,
            'city' => $this->city->city_name,
            'district_id' => $this->id,
            'district' => $this->location_name
        ];
        return $arrayData;
    }
}
