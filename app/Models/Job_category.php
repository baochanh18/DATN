<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job_category extends Model
{
    use HasFactory;

    protected $fillable = [ 'job_name' ];

    public function work_exp()
    {
        return $this->belongsTo(Work_exp::class);
    }

    public function job_desires()
    {
        return $this->belongsToMany(Job_desire::class);
    }

    public function job_details()
    {
        return $this->belongsToMany(Job_detail::class);
    }
}
