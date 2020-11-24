<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Job_detail as JobDetailResource;
use App\Http\Resources\Address as AddressResource;
use App\Http\Resources\JobCategory as JobCategoryResource;
use App\Http\Resources\Benefit as BenefitResource;

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
        if($this->company_size == 0)
            $arrayData['company_size_content'] = 'Ít hơn 10';
        else if($this->company_size == 1)
            $arrayData['company_size_content'] = '10-24';
        else if($this->company_size == 2)
            $arrayData['company_size_content'] = '25-99';
        else if($this->company_size == 3)
            $arrayData['company_size_content'] = '100-499';
        else if($this->company_size == 4)
            $arrayData['company_size_content'] = '500-999';
        else if($this->company_size == 5)
            $arrayData['company_size_content'] = '1.000-4.999';
        else if($this->company_size == 6)
            $arrayData['company_size_content'] = '5.000-9.999';
        else if($this->company_size == 7)
            $arrayData['company_size_content'] = '10.000-19.999';
        else if($this->company_size == 8)
            $arrayData['company_size_content'] = '20.000-49.999';
        else if($this->company_size == 9)
            $arrayData['company_size_content'] = 'Nhiều hơn 50.000';
        $date = Carbon::parse($this->active_day);
        $now = Carbon::now();
        $date = $date->addDays(30);
        $diff = $date->diffInDays($now);
        if($this->is_expire == 0)
            $arrayData['day_remain'] = $diff;

        $user = auth()->user();
        if($user == null)
            $arrayData['applied'] = 0;
        else
            if (count($this->applyCvs->where('user_id', $user->id)) == 0)
                $arrayData['applied'] = 0;
            else
                $arrayData['applied'] = 1;

        $arrayData['jobDetail'] = new JobDetailResource($this->jobDetail);
        $arrayData['benefits'] = BenefitResource::collection($this->benefits);
        $arrayData['addresses'] = AddressResource::collection($this->jobDetail->addresses);
        $arrayData['categories'] = JobCategoryResource::collection($this->jobDetail->jobCategories);

        Return $arrayData;
    }
}
