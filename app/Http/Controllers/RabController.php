<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Nomor;
use App\Http\Requests\RabRequest;
use App\Rab;
use App\User;
use Auth;
use App\Detailrab;
use App\Detailprogress;
use App\Project;
use Session;
use App\Mp;


class RabController extends Controller
{
	//
	private $data;

	public function index(){
	    if(Auth::user()->role == "pm"){
	        $rab = Rab::whereHas('project',function($q){
	            $q->where('pm_id','=',Auth::user()->id);
            })->get();
        }else{
            $rab = Rab::all();
        }


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

	public function update($id,Request $req){
	    $sub = 0;
        foreach($req->master_job_name as $key => $value){
            $detail_id = $req->detail_rab_id[$key];
            $check = Detailrab::where(['id'=>$detail_id])->count();
            if($check > 0){
                $update = Detailrab::find($detail_id);
                $update->master_job = $value;
                $update->sub_job_name = $req->sub_job_name[$key];
                $update->unit  = $req->unit[$key];
                $update->volume = $req->volume[$key];
                $update->unit_price = $req->unit_price[$key];
                $update->bobot = round((str_replace(",","",$req->volume[$key]) * str_replace(",","",$req->unit_price[$key])) / str_replace(",","",$req->estimate_total_budget) * 100,2);
                $update->save();
            }else{
                $create = new Detailrab();
                $create->rab_id = $id;
                $create->master_job = $req->master_job_name[$key];
                $create->sub_job_name = $req->sub_job_name[$key];
                $create->unit = $req->unit[$key];
                $create->volume = str_replace(",","",$req->volume[$key]);
                $create->unit_price = str_replace(",","",$req->unit_price[$key]);
                $create->bobot = round((str_replace(",","",$req->volume[$key]) * str_replace(",","",$req->unit_price[$key])) / str_replace(",","",$req->estimate_total_budget) * 100,2);
                $create->save();
            }

            $sub += (double) str_replace(",","",$req->volume[$key]) * (double) str_replace(",","",$req->unit_price[$key]);


        }

        $rab = Rab::find($id);
        $rab->estimate_total_budget = $sub;
        $rab->save();

        Session::flash('success','Rab has been updated');
        return redirect('rab');
	}

	public function edit($id){
		$rab = Rab::find($id);
		$detail_rab = Detailrab::where(['rab_id'=>$id])->get();
		$this->data['title'] = "Edit RAB - $id";
		$this->data['rab'] = $rab;
		$this->data['detail_rab'] = $detail_rab;
		return view("content.rab.edit",$this->data);
	}

	public function timeline($id){
        $rab = Rab::find($id);

        $detail_rab = Detailrab::where(['rab_id'=>$id])->get();
        $this->data['title'] = "Edit RAB - $id";
        $this->data['rab'] = $rab;
        $this->data['detail_rab'] = $detail_rab;
        $this->data['id']=$rab->project_id;
        return view("content.rab.timeline",$this->data);


    }

    public function progress($id){
        $rab = Rab::find($id);
        $progress = Detailprogress::where('rab_id',$id)
            ->groupBy('rab_id')
            ->groupBy('week_of')
            ->get();

        $detail_rab = Detailrab::where(['rab_id'=>$id])->get();
        $this->data['id'] = $id;
        $this->data['progress'] = $progress;
        $this->data['title'] = "Edit RAB - $id";
        $this->data['rab'] = $rab;
        $this->data['p_id']=$rab->project_id;
        $this->data['detail_rab'] = $detail_rab;
        return view("content.rab.progress",$this->data);
    }

    public function update_timeline($id,Request $req){

        foreach($req->master_job_name as $key => $value) {

            $detail_id = $req->detail_rab_id[$key];
            $update = Detailrab::find($detail_id);
            $update->start_date = $req->start_date[$key];
            $update->estimate_end_date = $req->estimate_end_date[$key];
            $update->end_date = $req->end_date[$key];
            $update->late_reason = $req->late_reason[$key];

            if(isset($req->finish[$key])){
                $update->status_sub = $req->finish[$key];
            }else{
                $update->status_sub = 0;
            }

            $update->save();
        }

        Session::flash('success','Rab has been updated');
        return redirect('rab');

    }

    public function insert_progress(Request $req){
        $check = Detailprogress::where(['week_of'=>$req->week,'rab_id'=>$req->rab_id])->count();
        if($check > 0){
            Session::flash('error',"Week of $req->week already created.");
            return redirect()->back();
        }

        foreach($req->master_job_name as $key => $value) {
            $insert = new Detailprogress();
            $insert->rab_id = $req->rab_id;
            $insert->rab_detail_id = $req->detail_rab_id[$key];
            $insert->week_of = $req->week;
            $insert->start_date = $req->start_date;
            $insert->end_date = $req->end_date;
            $insert->progress = $req->progress[$key];
            $insert->save();

            $update = Detailrab::find($req->detail_rab_id[$key]);
            $update->last_progress = $update->last_progress + $req->progress[$key];
            $last_total = $update->last_progress + $req->progress[$key];

            if($last_total ==100){
                $update->status_sub = 1;
            }

            $update->save();

        }

        Session::flash('success','Rab has been updated');
        return redirect('rab');
    }

    public function detail_progress($week,$id){
        $rab = Rab::find($id);
        $detail = Detailprogress::where(['week_of'=>$week,'rab_id'=>$id])->get();

        $this->data['id'] =$id;
        $this->data['detail_rab'] = $detail;
        $this->data['rab'] = $rab;
        $this->data['title'] = "Edit RAB - $id";
        return view("content.rab.detail_progress",$this->data);
    }

    public function update_progress_week($id,Request $req){
        foreach($req->detail_rab_id as $key => $value){
            $detail = Detailprogress::find($value);
            $dd = $detail->progress;
            $detail->progress = $req->progress[$key];
            $detail->week_of = $req->week;
            $detail->start_date = $req->start_date;
            $detail->end_date = $req->end_date;

            $detail->save();

            $update = Detailrab::find($req->detail_rab_id[$key]);
            $update->last_progress = $update->last_progress + ($req->progress[$key] - $dd);
            $update->save();

        }

        Session::flash('success','Rab has been updated');
        return redirect('rab');
    }

	public function _get_project(){
		$project = Project::where(function($q){
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
