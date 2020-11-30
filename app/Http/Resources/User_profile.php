<?php

namespace App\Http\Resources;

use App\Http\Resources\Address as AddressResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

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
            'id' => $this->id ,
            'name' => $this->name,
            'profileEmail' => $this->email,
            'phone' => $this->phone,
            'avatar' => Storage::cloud()->temporaryUrl($this->avatar, now()->addMinutes(60)),
            'avatar_path' => $this->avatar,
            'birthday' => Carbon::parse($this->birthday)->format('Y-m-d'),
            'gender' => $this->gender,
        ];

        if(count($this->address()->get()) > 0)
            $arrayData['address'] = new AddressResource($this->address);

        return $arrayData;
    }
}
