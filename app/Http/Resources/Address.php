<?php

namespace App\Http\Resources;

use App\Models\Location;
use App\Http\Resources\Location as LocationResource;
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
            'city_id' => $this->city->id ,
            'city' => $this->city->city_name,
        ];

        if(count($this->location()->get()) > 0)
        {
            $arrayData['locations'] = new LocationResource($this->location) ;
        }
        if($this->address_name != null)
        {
            $arrayData['address_name'] = $this->address_name ;
        }
        return $arrayData;
    }
}
