<?php

namespace App\Http\Resources;

use App\Http\Resources\Address as AddressResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class User_profile extends JsonResource
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
            'name' => $this->name,
            'profileEmail' => $this->email,
            'phone' => $this->phone,
            'avatar' => $this->avatar,
            'birthday' => Carbon::parse($this->birthday)->format('Y-m-d'),
            'gender' => $this->gender,
        ];

        if(count($this->address()->get()) > 0)
            $arrayData['address'] = new AddressResource($this->address);

        return $arrayData;
    }
}
