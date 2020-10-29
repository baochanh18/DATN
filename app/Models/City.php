<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = [ 'city_name', 'zipcode' ];

    public function locations(){
        return $this->hasMany(Location::class);
    }
}