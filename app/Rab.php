<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rab extends Model
{
    //
    public $timestamp = true;
    protected $table = "rab";

    public function project(){
    	return $this->belongsTo('App\Project','project_id');
    }
}
