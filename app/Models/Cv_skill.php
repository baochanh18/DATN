<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cv_skill extends Model
{
    use HasFactory;

    protected $fillable = [ 'cv_id', 'skill_category_id', 'skill_name', 'skill_level',
                            'year_of_use', 'skill_descriptions' ];

    public function cv()
    {
        return $this->belongsTo(Cv::class);
    }

    public function skillCategory()
    {
        return $this->hasOne(Skill_category::class);
    }
}
