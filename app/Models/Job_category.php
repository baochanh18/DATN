<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job_category extends Model
{
    use HasFactory;

    protected $fillable = [ 'job_name' ];

    public function jobDetails()
    {
        return $this->belongsToMany(Job_detail::class);
    }
}
