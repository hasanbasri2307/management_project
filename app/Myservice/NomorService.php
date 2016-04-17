<?php

namespace App\Myservice;

use DB;

class NomorService {
	private $result;
	private $code;

	public function getNomor($table,$field,$code){
		$this->code = $code;
		$start = 4 + intval(strlen($code)) + 1 +1;
		$hasil = DB::select("select ".$field." from ".$table." where SUBSTRING(".$field.",".$start.",4) = YEAR(CURDATE()) AND SUBSTRING(".$field.",".intval($start+5).",2) = MONTH(CURDATE()) order by ".$field." DESC LIMIT 1");
		if(is_null($hasil))
			$this->result = 0;
		else
			$this->result = substr($hasil[0]->{$field},17);
		
		return sprintf('AKU-%s/%s/%s-%05d',$this->code,date("Y"),date("m"),$this->result + 1);
	}
}