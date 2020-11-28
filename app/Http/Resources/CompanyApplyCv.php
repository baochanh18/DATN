<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CompanyApplyCv extends JsonResource
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
            'user_id' => $this->user_id,
            'job_id' => $this->job_id,
            'full_name' => $this->full_name,
            'title' => $this->title,
            'email' => $this->email,
            'cv_status' => $this->cv_status,
            'phone_number' => $this->phone_number,
            'cv_file' => Storage::cloud()->temporaryUrl($this->cv_file, now()->addMinutes(60)),
            'created_at' => $this->created_at->format('Y-m-d')
        ];

        return $arrayData;
    }
}
