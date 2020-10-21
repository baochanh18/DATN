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
            'country' => $this->country->country_name ,
            'address' => $this->address  ,
        ];

        if(count($this->location()->get()) > 0)
        {
            $arrayData['city'] = Location::find($this->location->parent_id)->location_name;
            $arrayData['district'] = $this->location->location_name ;
        }

        return $arrayData;
    }
}
