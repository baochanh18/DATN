<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [ 'user_id', 'job_title', 'company_name', 'company_website_url',
                            'company_youtube_url', 'company_descriptions', 'company_size' ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jobContact()
    {
        return $this->hasOne(Job_contact::class);
    }

    public function jobDetail()
    {
        return $this->hasOne(Job_detail::class);
    }
}
