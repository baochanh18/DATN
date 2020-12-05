<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [ 'address_name', 'city_id', 'address', 'location_id',
        'user_profile_id', 'company_profile_id', 'country_id' ];

    public function userProfile()
    {
        return $this->belongsTo(User_profile::class);
    }

    public function companyProfile()
    {
        return $this->belongsTo(Company_profile::class);
    }

    public function jobDetails()
    {
        return $this->belongsToMany(Job_detail::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
