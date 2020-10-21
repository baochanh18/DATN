<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job_category extends Model
{
    use HasFactory;

    protected $fillable = [ 'job_name' ];

    public function workExp()
    {
        return $this->belongsTo(Work_exp::class);
    }

    public function jobDesires()
    {
        return $this->belongsToMany(Job_desire::class);
    }

    public function jobDetails()
    {
        return $this->belongsToMany(Job_detail::class);
    }
}
