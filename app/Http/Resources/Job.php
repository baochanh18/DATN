<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Job_detail as JobDetailResource;
use App\Http\Resources\Address as AddressResource;
use App\Http\Resources\JobCategory as JobCategoryResource;

class Job extends JsonResource
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
            'job_title' => $this->job_title,
            'company_name' => $this->company_name,
            'company_website_url' => $this->company_website_url,
            'company_youtube_url' => $this->company_youtube_url,
            'company_logo' => $this->company_logo,
            'address' => $this->address,
            'active_day' => $this->active_day,
            'company_descriptions' => $this->company_descriptions,
            'company_size' => $this->company_size,
            'created_at' => $this->created_at->format('Y-m-d'),
            'updated_at' => $this->updated_at->format('Y-m-d'),
        ];
        $arrayData['jobDetail'] = new JobDetailResource($this->jobDetail);
//        $arrayData['job_detail'] = 'new JobDetailResource($this->jobDetail)';
        $arrayData['addresses'] = AddressResource::collection($this->jobDetail->addresses);
        $arrayData['categories'] = JobCategoryResource::collection($this->jobDetail->jobCategories);

        Return $arrayData;
    }
}
