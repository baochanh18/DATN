<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill_category extends Model
{
    use HasFactory;

    protected $fillable = [ 'parent_id', 'skill_name'];

    public function cv_skill()
    {
        return $this->belongsTo(Cv_skill::class);
    }
}
