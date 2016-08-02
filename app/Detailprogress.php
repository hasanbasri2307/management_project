<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detailprogress extends Model
{
    //
    public $timestamp = true;
    protected $table = "rab_progress";

    public function detail_rab(){
        return $this->belongsTo('App\Detailrab','rab_detail_id');
    }
}
