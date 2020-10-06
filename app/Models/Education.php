<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $fillable = [ 'cv_id', 'literacy', 'school_name', 'major_id', 'country_id', 'start_month',
                            'start_year', 'end_month', 'end_year', 'descriptions' ];

    public function cv()
    {
        return $this->belongsTo(Cv::class);
    }

    public function major()
    {
        return $this->hasOne(Major::class);
    }

    public function country()
    {
        return $this->hasOne(Country::class);
    }
}
