<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Job_detail extends JsonResource
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
            'job_level' => $this->job_level,
            'job_type' => $this->job_type,
            'job_salary_type' => $this->job_salary_type,
            'job_minimum_salary' => $this->job_minimum_salary,
            'job_maximum_salary' => $this->job_maximum_salary,
            'job_description' => $this->job_description,
            'job_requirement' => $this->job_requirement,
            'cv_language' => $this->cv_language,
            'contact_name' => $this->contact_name,
            'contact_email' => $this->contact_email,
        ];

        if($this->job_level == 0)
            $arrayData['job_level_name'] = 'Mới tốt nghiệp';
        if($this->job_level == 1)
            $arrayData['job_level_name'] = 'Nhân viên';
        if($this->job_level == 2)
            $arrayData['job_level_name'] = 'Trưởng phòng';
        if($this->job_level == 3)
            $arrayData['job_level_name'] = 'Giám đốc hoặc cao hơn';

        Return $arrayData;
    }
}
