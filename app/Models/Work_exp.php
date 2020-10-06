<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work_exp extends Model
{
    use HasFactory;

    protected $fillable = [ 'cv_id', 'company_name', 'year_of_work', 'position', 'job_category_id',
                            'start_month', 'start_year', 'end_month', 'end_year', 'work_exp_description'];

    public function cv()
    {
        return $this->belongsTo(Cv::class);
    }

    public function job_category()
    {
        return $this->hasOne(Job_category::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
