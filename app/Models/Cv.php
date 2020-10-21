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

    public function  foreignLanguages()
    {
        return $this->hasMany(Foreign_language::class);
    }

    public function educations()
    {
        return $this->hasMany(Education::class);
    }

    public function cvSkills()
    {
        return $this->hasMany(Cv_skill::class);
    }

    public function workExps()
    {
        return $this->hasMany(Work_exp::class);
    }

    public function jobDesire()
    {
        return $this->hasOne(Job_desire::class);
    }
}
