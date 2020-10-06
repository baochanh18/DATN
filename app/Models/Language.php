<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $fillable = [ 'language_name' ];

    public function foreign_language()
    {
        return $this->belongsTo(Foreign_language::class);
    }
}
