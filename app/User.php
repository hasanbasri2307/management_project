<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

	public $timestamp = true;
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

    public function client(){
        return $this->hasOne('App\Client','user_id');
    }

    public function project_client(){
        return $this->hasMany('App\Project','client_id');
    }

    public function project_pm(){
        return $this->hasMany('App\Project','pm_id');
    }

    public function project_lastupdate(){
         return $this->hasMany('App\Project','last_update_by');
    }
}
