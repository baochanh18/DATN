<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job_detail extends Model
{
    use HasFactory;

    protected $fillable = [ 'job_id', 'job_salary_type', 'job_minimum_salary', 'job_maximum_salary', 'job_money_type',
                            'job_minimum_age', 'job_maximum_age', 'gender', 'job_description',
                            'job_literacy', 'year_of_work', 'job_requirement' ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function job_categories()
    {
        return $this->belongsToMany(Job_category::class);
    }
}
