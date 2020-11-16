<?php

namespace App\Models;

use App\Enums\UserRole;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'username','password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeFilter($query, $request)
    {
        if(count($request))
            foreach($request as $field )
            {
                if($field['id'] == 'email')
                    $query->where('email', 'LIKE', '%' . $field['value'] . '%');
                else if($field['id'] == 'role' || $field['id'] == 'id' || $field['id'] == 'isActive')
                {
                    if ($field['value'] == "all")
                        continue;
                    else
                        $query->where($field['id'], '=', $field['value']);
                }
                else
                {
                    if($field['id'] == 'name')
                        $query->whereHas('userProfile', function ($query) use ($field) {
                            $query->where('name', 'LIKE', '%' . $field['value'] . '%');
                        });
                    else if($field['id'] == 'city')
                    {
                        $query->whereHas('userProfile', function ($query) use ($field) {
                            $query->whereHas('address', function ($query) use ($field) {
                                $query->whereHas('location', function ($query) use ($field) {
                                    $query->whereHas('city', function ($query) use ($field) {
                                        $query->where('city_name', 'LIKE', '%' . $field['value'] . '%');
                                    });
                                });
                            });
                        });
                    }
                    else if($field['id'] == 'country')
                    {
                        $query->whereHas('userProfile', function ($query) use ($field) {
                            $query->whereHas('address', function ($query) use ($field) {
                                $query->whereHas('country', function ($query) use ($field) {
                                    $query->where('country_name', 'LIKE', '%' . $field['value'] . '%');
                                });
                            });
                        });
                    }
                }
            }

        return $query;
    }

    public function scopeFilterCom($query, $request)
    {
        if(count($request))
            foreach($request as $field )
            {
                if($field['id'] == 'email')
                    $query->where('email', 'LIKE', '%' . $field['value'] . '%');
                else if($field['id'] == 'role' || $field['id'] == 'id' || $field['id'] == 'isActive' )
                {
                    if ($field['value'] == "all")
                        continue;
                    else
                        $query->where($field['id'], '=', $field['value']);
                }
                else
                {
                    if($field['id'] == "company_size")
                        if($field['value'] == "all")
                            continue;
                        else
                            $query->whereHas('companyProfile', function ($query) use ($field) {
                                $query->where("company_size", '=', $field['value']);
                            });
                    else
                    {
                        $query->whereHas('companyProfile', function ($query) use ($field) {
                            $query->where($field['id'], 'LIKE', '%' . $field['value'] . '%');
                        });
                    }
                }
            }

        return $query;
    }

    public function scopeSort($query, $request)
    {
        if(count($request))
        {
            if($request[0]['id'] == 'id' || $request[0]['id'] == 'email' || $request[0]['id'] == 'role' ||
                $request[0]['id'] == 'isActive')
                if($request[0]['desc'])
                    $query->orderBy($request[0]['id'], 'desc');
                else
                    $query->orderBy($request[0]['id']);
        }

        return $query;
    }

    public function scopeSortCom($query, $request)
    {
        if(count($request))
        {
            if($request[0]['id'] == 'email' || $request[0]['id'] == 'isActive')
                if($request[0]['desc'])
                    $query->orderBy($request[0]['id'], 'desc');
                else
                    $query->orderBy($request[0]['id']);
        }

        return $query;
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function userProfile()
    {
        return $this->hasOne(User_profile::class);
    }

    public function userable()
    {
        return $this->morphTo();
    }

    public function companyProfile()
    {
        return $this->hasOne(Company_profile::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function cvs()
    {
        return $this->hasMany(Cv::class);
    }
}
