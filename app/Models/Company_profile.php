<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company_profile extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'description', 'company_size', 'website_url', 'youtube_url', 'logo',
                            'contact_office_name', 'contact_office_phone', 'contact_office_fax', 'contact_office_email',
                            'contact_person_name', 'contact_person_phone'];

    public function user()
    {
//        return $this->belongsTo(User::class);
        return $this->morphOne('App\models\User', 'userable');
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
