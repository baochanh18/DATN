<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foreign_language extends Model
{
    use HasFactory;

    protected $fillable = [ 'cv_id', 'language_id', 'language_level' ];

    public function cv()
    {
        return $this->belongsTo(Cv::class);
    }

    public function language()
    {
        return $this->hasOne(Language::class);
    }
}
