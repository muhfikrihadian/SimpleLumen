<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use Spatie\Permission\Traits\HasRoles;
// use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable, HasRoles;
    // use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function name()
    {
        if (Auth::check()) {
            if (strlen(Auth::user()->name) >= 20) {
                $auth = explode(' ', Auth::user()->name);
                foreach ($auth as $key => $value) {
                    if ($key != 0) {
                        $auth[$key] = strtoupper(substr($value, 0, 1)).'.';
                    }
                }
                return implode(' ', $auth);
            }

            return Auth::user()->name;
        }

        return config('app.name', 'Laravel');
    }

    public static function breadcumb()
    {
        if (\Request::segment(1) != null) {
            $breadcumb = ucfirst(\Request::segment(1));
        }
        else {
            $breadcumb = 'Dashboard';
        }

        if (\Request::segment(2) != null && strlen(\Request::segment(2)) <= 15) {
            $breadcumb .= '&nbsp;<i class="fas fa-fw fa-angle-right"></i>&nbsp;'.ucfirst(\Request::segment(2));
        }

        if (\Request::segment(3) != null) {
            $breadcumb .= '&nbsp;<i class="fas fa-fw fa-angle-right"></i>&nbsp;'.ucfirst(\Request::segment(3));
        }
        return $breadcumb; 
    }
}
