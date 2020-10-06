<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job_desire extends Model
{
    use HasFactory;

    protected $fillable = [ 'cv_id', 'job_title', 'desire_salary_type', 'desire_minimum_salary',
                            'desire_maximum_salary', 'desire_money_type', 'desire_job_position',
                            'desire_job_type', 'desire_job_description' ];

    public function cv()
    {
        return $this->belongsTo(Cv::class);
    }

    public function job_categories()
    {
        return $this->belongsToMany(Job_category::class);
    }

    public function  addresses()
    {
        return $this->hasMany(Address::class);
    }
}
