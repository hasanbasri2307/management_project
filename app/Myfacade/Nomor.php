<?php

namespace App\Myfacade;
use App\Myservice\NomorService;

use Illuminate\Support\Facades\Facade;

class Nomor extends Facade {
	protected static function getFacadeAccessor() {
        return 'NomorService';
    }
}