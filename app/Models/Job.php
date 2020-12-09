<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [ 'user_id', 'job_title', 'company_name', 'address','company_website_url',
                            'company_youtube_url', 'company_logo', 'is_expire', 'active_day', 'job_status',
                            'company_descriptions', 'company_size' ];

    public function scopeCitysearch($query, $city)
    {
        $query->whereHas('jobDetail', function (Builder $query) use ($city) {
            $query->whereHas('addresses', function (Builder $query) use ($city) {
               $query->where('city_id', $city);
            });
        });
        return $query;
    }

    public function scopeCategorysearch($query, $category)
    {
        $query->whereHas('jobDetail', function (Builder $query) use ($category) {
            $query->whereHas('jobCategories', function (Builder $query) use ($category) {
                $query->where('job_name', $category);
            });
        });
        return $query;
    }

    public function scopeLevelsearch($query, $level)
    {
        $query->whereHas('jobDetail', function (Builder $query) use ($level) {
            $query->where('job_level', $level);
        });
        return $query;
    }

    public function scopeSalarysearch($query, $salary)
    {
        $query->whereHas('jobDetail', function (Builder $query) use ($salary) {
            if ($salary == 0)
                $query->where('job_salary_type', 0)->where('job_minimum_salary', '<=', 500)
                    ->orWhere('job_maximum_salary', '<=', 500);
            else  if ($salary == 1)
                $query->where('job_salary_type', 0)->where('job_minimum_salary', '>=', 500)
                      ->where('job_maximum_salary', '<=', 1000);
            else  if ($salary == 2)
                $query->where('job_salary_type', 0)->where('job_minimum_salary', '>=', 1000)
                      ->where('job_maximum_salary', '<=', 2000);
            else  if ($salary == 3)
                $query->where('job_salary_type', 0)->where('job_minimum_salary', '>=', 2000)
                    ->orWhere('job_maximum_salary', '>', 2000);
            else  if ($salary == 4)
                $query->where('job_salary_type', 1);
            else
                return $query;
        });
        return $query;
    }

    public function scopeFiltersearch($query, $filter)
    {
        $query->where('job_title', 'like', '%'.$filter.'%')
            ->orWhere('company_name', 'like', '%'.$filter.'%')
            ->orWhereHas('jobDetail', function (Builder $query) use ($filter) {
                $query->Where('job_description', 'like', '%'.$filter.'%')
                    ->orWhereHas('jobCategories', function (Builder $query) use ($filter) {
                       $query->where('job_name', 'like', '%'.$filter.'%');
                    });
            });
        return $query;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jobDetail()
    {
        return $this->hasOne(Job_detail::class);
    }

    public function benefits()
    {
        return $this->hasMany(Benefit::class);
    }

    public function applyCvs()
    {
        return $this->hasMany(Apply_cv::class);
    }

    public function savedJobs()
    {
        return $this->hasMany(Saved_job::class);
    }

    #region Accessors

    /**
     * @return string
     */
    public function getCompanySizeContentAttribute()
    {
        if($this->company_size == 0)
            return 'Ít hơn 10';
        else if($this->company_size == 1)
            return '10-24';
        else if($this->company_size == 2)
            return '25-99';
        else if($this->company_size == 3)
            return '100-499';
        else if($this->company_size == 4)
            return '500-999';
        else if($this->company_size == 5)
            return '1.000-4.999';
        else if($this->company_size == 6)
            return '5.000-9.999';
        else if($this->company_size == 7)
            return '10.000-19.999';
        else if($this->company_size == 8)
            return '20.000-49.999';
        else if($this->company_size == 9)
            return 'Nhiều hơn 50.000';
        return 'Khong xac dinh';
    }

//    public function getEndDayAttribute()
//    {
//        $date = Carbon::parse($this->active_day);
//        $date = $date->addDays(30);
//        return $date;
//    }
//    public function getDayRemain()
//    {
//        $diff = $this->end_day->diffInDays(Carbon::now());
//        if($this->is_expire == 0)
//            return $diff;
//        return null;
//    }
    #endregion
}
