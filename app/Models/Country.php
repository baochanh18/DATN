<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [ 'country_name', 'zipcode'];

    public function education()
    {
        return $this->belongsTo(Education::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
