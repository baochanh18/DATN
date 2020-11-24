<?php

namespace App\Http\Resources;

use App\Http\Resources\Address as AddressResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ShortJobInfo extends JsonResource
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
            'job_title' => $this->job_title,
            'active_day' => $this->active_day,
            'job_salary_type' => $this->jobDetail->job_salary_type,
            'job_minimum_salary' => $this->jobDetail->job_minimum_salary,
            'job_maximum_salary' => $this->jobDetail->job_maximum_salary
        ];

        $arrayData['addresses'] = AddressResource::collection($this->jobDetail->addresses);

        return $arrayData;
    }
}
