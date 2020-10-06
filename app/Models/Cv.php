<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    use HasFactory;

    protected $fillable = [ 'user_id', 'title', 'name', 'gender', 'birthday', 'marital_status', 'nationality',
                            'avatar', 'phone',  'email', 'cv_status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function  address()
    {
        return $this->hasOne(Address::class);
    }

    public function  foreign_languages()
    {
        return $this->hasMany(Foreign_language::class);
    }

    public function educations()
    {
        return $this->hasMany(Education::class);
    }

    public function cv_skills()
    {
        return $this->hasMany(Cv_skill::class);
    }

    public function work_exps()
    {
        return $this->hasMany(Work_exp::class);
    }

    public function job_desire()
    {
        return $this->hasOne(Job_desire::class);
    }
}
