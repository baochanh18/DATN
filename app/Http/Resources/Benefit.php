<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Benefit extends JsonResource
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
            'benefits_description' => $this->benefits_description ,
        ];

        return $arrayData;
    }
}
