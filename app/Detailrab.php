<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detailrab extends Model
{
    //
    public $timestamp = true;
    protected $table = "rab_detail";

    public function progress_rab(){
        return $this->hasOne('App\Detailprogress','rab_detail_id');
    }
}
