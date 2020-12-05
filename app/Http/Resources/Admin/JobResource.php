<?php

namespace App\Http\Resources\Admin;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
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
            'username' => $this->user->username,
            'email' => $this->user->email,
            'job_title' => $this->job_title,
            'active_day' => $this->active_day,
        ];

        $date = Carbon::parse($this->active_day);
        $now = Carbon::now();
        $date = $date->addDays(30);
        $arrayData['end_day'] = $date->format('Y-m-d');
        $diff = $date->diffInDays($now);
        if($this->is_expire == 0)
            $arrayData['day_remain'] = $diff;

        return $arrayData;
    }
}
