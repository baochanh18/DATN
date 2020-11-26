<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [ 'country_name', 'zipcode'];

    public function location()
    {
        return $this->hasMany(Location::class);
    }

    public function  addresses()
    {
        return $this->hasMany(Address::class);
    }
}
