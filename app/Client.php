<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    public $timestamp = true;
    protected $table = "client";

    public function user(){
    	return $this->belongsTo('App\User','user_id');
    }
}
