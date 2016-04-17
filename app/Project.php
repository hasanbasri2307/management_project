<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    public $timestamp = true;
    protected $table = "project";

    public function client(){
    	return $this->belongsTo('App\User','client_id');
    }

    public function pm(){
    	return $this->belongsTo('App\User','pm_id');
    }

    public function user_lastupdate(){
    	return $this->belongsTo('App\User','last_update_by');
    }
}
