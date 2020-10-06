<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job_contact extends Model
{
    use HasFactory;

    protected $fillable = [ 'job_id', 'cv_language', 'contact_description', 'is_online_submit',
                            'is_directly_submit', 'contact_name', 'contact_phone', 'contact_email' ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
