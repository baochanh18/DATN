<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job_detail extends Model
{
    use HasFactory;

    protected $fillable = [ 'job_id', 'job_salary_type', 'job_minimum_salary', 'job_maximum_salary', 'job_level',
                            'job_type', 'job_description', 'job_requirement', 'cv_language'];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function addresses()
    {
        return $this->belongsToMany(Address::class);
    }

    public function jobCategories()
    {
        return $this->belongsToMany(Job_category::class);
    }
}
