<?php

namespace App\Http\Resources;

use App\Models\Location;
use Illuminate\Http\Resources\Json\JsonResource;

class Address extends JsonResource
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
            'id' => $this->id ,
            'country' => $this->country->country_name ,
            'address' => $this->address  ,
        ];

        if(count($this->location()->get()) > 0)
        {
            $arrayData['city_id'] = $this->location->city->id ;
            $arrayData['city'] = $this->location->city->city_name ;
            $arrayData['district_id'] = $this->location->id ;
            $arrayData['district'] = $this->location->location_name ;
        }
        return $arrayData;
    }
}
