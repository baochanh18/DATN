<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apply_cv extends Model
{
    use HasFactory;
    protected $fillable = [ 'user_id', 'job_id', 'full_name', 'title', 'email', 'phone_number', 'cv_file' ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
