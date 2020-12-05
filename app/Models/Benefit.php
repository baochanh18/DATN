<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Benefit extends Model
{
    use HasFactory;

    protected $fillable = [ 'job_id', 'benefits_description'];

    public function companyProfile ()
    {
        return $this->belongsTo(Company_profile::class);
    }

    public function job ()
    {
        return $this->belongsTo(Job::class);
    }
}
