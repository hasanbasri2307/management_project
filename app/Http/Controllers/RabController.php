<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Nomor;
use App\Http\Requests\RabRequest;
use App\Rab;
use App\User;
use Auth;
use App\Detailrab;
use App\Project;
use Session;
use App\Mp;


class RabController extends Controller
{
    //
    private $data;

    public function index(){
    	$rab = Rab::all();
       
    	$this->data['rab'] = $rab;
       
    	$this->data['title'] = "RAB";
    	return view("content.rab.list",$this->data);
    }

    public function create(){
    	$this->data['title'] = "Rab Create";
    	$this->data['project'] = $this->_get_project();
    	return view("content.rab.create",$this->data);
    }

	public function save(RabRequest $req){
		$rab = new Rab();
		$rab->no_rab = Nomor::getNomor("rab","no_rab","RAB");
		$rab->project_id = $req->project_id;
		$rab->estimate_total_budget = str_replace(",","",$req->estimate_total_budget);
		if ($req->file('file_attach')->isValid()) {
			//
			$filename = md5(time().$req->file('file_attach')->getClientOriginalName());
			$destinationPath = public_path('uploads');
			$req->file('file_attach')->move($destinationPath,$filename.'.'.$req->file('file_attach')->getClientOriginalExtension());
			$rab->file_attach = $filename.'.'.$req->file('file_attach')->getClientOriginalExtension();
		}

		$rab->save();


		foreach($req->sub_job_name as $k => $val){
			$detail = new Detailrab();
			$detail->rab_id = $rab->id;
			$detail->master_job = $req->master_jobs[$k];
			$detail->sub_job_name = $req->sub_job_name[$k];
			$detail->unit = $req->unit[$k];
			$detail->volume = str_replace(",","",$req->volume[$k]);
			$detail->unit_price = str_replace(",","",$req->unit_price[$k]);
			$detail->bobot = round((str_replace(",","",$req->volume[$k]) * str_replace(",","",$req->unit_price[$k])) / str_replace(",","",$req->estimate_total_budget) * 100,2);
			$detail->save();
		}


		Session::flash('success','Rab has been created');
		return redirect('rab');
	}

    public function delete($id){

    }

    public function update($id){

    }

    public function edit($id){

    }

    public function _get_project(){
    	$project = Project::where("pm_id","=",Auth::user()->id)
    				->where(function($q){
    					$q->where("status_project","0")
    					->orWhere("status_project","1");

    				})->get();

    	$result = [];
    	foreach($project as $item){
    		$result[$item->id] = $item->no_project;
    	}

    	return $result;
    }

}
