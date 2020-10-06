<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [ 'job_desire_id', 'work_exp_id', 'company_profile_id', 'job_contact_id', 'job_detail_id',
                            'country_id', 'address', 'location_id', 'user_profile_id', 'cv_id' ];

    public function user_profile()
    {
        return $this->belongsTo(User_profile::class);
    }

    public function company_profile()
    {
        return $this->belongsTo(Company_profile::class);
    }

    public function  cv()
    {
        return $this->belongsTo(Cv::class);
    }

    public function job_desire()
    {
        return $this->belongsTo(Job_desire::class);
    }

    public function work_exp()
    {
        return $this->belongsTo(Work_exp::class);
    }

    public function job_contact()
    {
        return $this->belongsTo(Job_contact::class);
    }

    public function job_detail()
    {
        return $this->belongsTo(Job_detail::class);
    }

    public function country()
    {
        return $this->hasOne(Country::class);
    }

    public function location()
    {
        return $this->hasOne(Location::class);
    }
}
