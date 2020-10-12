<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_profile extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'email', 'birthday', 'gender', 'phone', 'avatar'];

    protected $dates = [
        'birthday',
    ];

    protected $dateFormat = 'Y-m-d';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }
}
