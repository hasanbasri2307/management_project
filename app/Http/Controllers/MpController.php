<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use App\Mp;
use App\Http\Requests\MpRequest;

class MpController extends Controller
{
    //
    private $data;

    public function index(){
    	$mp = Mp::orderBy('id','asc')->get();
    	$this->data['mp'] = $mp;
    	$this->data['title'] = "Master Job";
    	return view("content.master.master_job.list",$this->data);
    }

    public function create(){
    	$this->data['title'] = "Master Job Create";
    	return view("content.master.master_job.create",$this->data);
    }

    public function save(MpRequest $request){
    	$mp = new Mp();
    	$mp->mp_name = $request->mp_name;
    	$mp->description = $request->description;
    	$mp->save();

    	Session::flash('success','Master job has been created');
    	return redirect('master-job');
    }

    public function edit($id,$name){
    	$mp = Mp::find($id);
    	$this->data['mp'] = $mp;
    	$this->data['title'] = "Master Job Edit ($mp->id - $mp->mp_name)";
    	return view("content.master.master_job.edit",$this->data);
    }

    public function update(MpRequest $request,$id){
    	$mp = Mp::find($id);
    	$mp->mp_name = $request->mp_name;
    	$mp->description = $request->description;
    	$mp->save();

    	Session::flash('success','Master job has been updated');
    	return redirect('master-job');
    }

    public function delete($id){
    	$user = Mp::find($id);
    	$user->delete();

    	Session::flash('success','Master job has been deleted');
    	return redirect('master-job');
    }
}
