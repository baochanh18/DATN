<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [ 'country_id', 'parent_id', 'location_name', 'zipcode' ];

    public function country()
    {
        return $this->hasOne(Country::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}
