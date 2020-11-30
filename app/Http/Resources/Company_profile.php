<?php

namespace App\Http\Resources;

use App\Http\Resources\Address as AddressResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class Company_profile extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id ,
            'name' => $this->name,
            'description' => $this->description,
            'company_size' => $this->company_size,
            'website_url' => $this->website_url,
            'youtube_url' => $this->youtube_url,
            'logo' => Storage::cloud()->temporaryUrl($this->logo, now()->addMinutes(60)),
            'logo_path' => $this->logo,
            'contact_office_name' => $this->contact_office_name,
            'contact_office_phone' => $this->contact_office_phone,
            'contact_office_fax' => $this->contact_office_fax,
            'contact_office_email' => $this->contact_office_email,
            'contact_person_name' => $this->contact_person_name,
            'contact_person_phone' => $this->contact_person_name,
            'address' => AddressResource::collection($this->addresses),
        ];
    }
}
