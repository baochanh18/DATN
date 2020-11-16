<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User_profile as UserProfileResource;
use App\Http\Resources\Company_profile as CompanyProfileResource;
use App\Enums\UserRole;

class User extends JsonResource
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
            'id' => $this->id,
            'email' => $this->email,
            'username' => $this->username,
            'role' => UserRole::getKey( $this->role ) ,
            'isActive' => $this->isActive,
            'created_at' => $this->created_at->format('Y-m-d'),
            'updated_at' => $this->updated_at->format('Y-m-d'),
        ];

        if($this->role != UserRole::Company)
        {
            $arrayData['userProfile'] = new UserProfileResource($this->userProfile);
            $arrayData['companyProfile'] = [];
        }
        else
        {
            $arrayData['userProfile'] = [];
            $arrayData['companyProfile'] = new CompanyProfileResource($this->companyProfile);
        }

        Return $arrayData;
    }
}
