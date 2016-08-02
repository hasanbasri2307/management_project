<?php

namespace App\Http\Controllers;

use App\Myservice\NomorService;

use Illuminate\Http\Request;
use Nomor;
use App\Http\Requests\ProjectRequest;
use App\Project;
use App\User;
use App\Rab;
use App\Detailrab;
use App\Detailprogress;
use Auth;
use Session;
use Excel;

class ProjectController extends Controller
{
    //
    private $data;
    private $role;

    public function __construct(){
        $this->role = Auth::user()->role;
    }

    public function index(){
    	$project = Project::all();
    	$this->data['project'] = $project;
    	$this->data['title'] = "Project";
    	return view("content.project.list",$this->data);
    }

    public function create(){
    	$this->data['title'] = "Project Create";
    	$this->data['client'] = $this->_get_user_by_role("client");
    	$this->data['pm'] = $this->_get_user_by_role("pm");
    	return view("content.project.create",$this->data);
    }

    public function save(ProjectRequest $request){
    	$project = new Project();
    	$project->no_project = Nomor::getNomor("project","no_project","PRJ");
    	$project->p_name = $request->p_name;
    	$project->p_address = $request->p_address;
    	$project->client_id = $request->client_id;
        $project->pm_id = $request->pm_id;
        $project->status_project = $request->status_project;
        $project->last_update_by = Auth::user()->id;
    	$project->save();

    	Session::flash('success','Project has been created');
    	return redirect('project');
    }

    public function edit($id,$name){
    	$project = Project::find($id);
    	$this->data['project'] = $project;
    	$this->data['client'] = $this->_get_user_by_role("client");
    	$this->data['pm'] = $this->_get_user_by_role("pm");
    	$this->data['title'] = "Project Edit ($project->id - $project->no_project)";
    	return view("content.project.edit",$this->data);
    }

    public function update(projectRequest $request,$id){
    	$project = Project::find($id);
        $project->p_name = $request->p_name;
        $project->p_address = $request->p_address;
        $project->client_id = $request->client_id;
        $project->start_date = $request->start_date;
        $project->estimate_end_date = $request->estimate_end_date;

        $project->pm_id = $request->pm_id;
        $project->status_project = $request->status_project;
        $project->last_update_by = Auth::user()->id;
    	$project->save();

    	Session::flash('success','Project has been updated');
    	return redirect('project');
    }

    public function patch(projectRequest $request,$id){
        $project = Project::find($id);
        $project->end_date = $request->end_date;
        $project->status_project = $request->status_project;
        $project->last_update_by = Auth::user()->id;
        $project->save();

        Session::flash('success','Project has been updated');
        return redirect('project');
    }

    public function delete($id){
    	$project = Project::find($id);
    	$project->delete();

    	Session::flash('success','Project has been deleted');
    	return redirect('project');
    }

    private function _get_user_by_role($role){
    	$users = User::where(['role'=>$role,'status_user'=> 1])->get();
    	$result = [];

    	foreach($users as $user){
    		if($role == "client"){
    			$result[$user->id] = $user->client->company_name;
    		}else{
    			$result[$user->id] = $user->name;
    		}
    	}

    	return $result;
    }

    public function get_project_by_id($id){
        $project = Project::with(['client'])->find($id);
        $res = [
            "p_name" => $project->p_name,
            "client" => $project->client->client->company_name,
            "p_address" => $project->p_address
        ];

        $data['project'] = $res;
        $data['status'] = true;

        return response()->json($data);
    }

    public function get_detail_project($id,Request $request){
        $data=[];
        if($request->ajax()){
            $project = Project::find($id);
            $data['no_project'] = $project->no_project;
            $data['view'] = view("content.project.detail")->with("project",$project)->render();
            $data['status'] = true;

            return response()->json($data);
        }

        $data['status'] = false;
        return response()->json($data);
    }

    public function get_detail_user($id,Request $request){
    	$data = [];
    	if($request->ajax()){
    		$user = User::with(["client"])->find($id);

    		$data['user'] = $user;
    		$data['status'] = true;

    		return response()->json($data);
    	}

    	$data['status'] = false;
    	return response()->json($data);
    }

    public function client($id){
        $project = Project::where(['client_id'=>$id])->get();
        $this->data['title'] = "Project List";
        $this->data['project'] = $project;
        return view("content.project.client",$this->data);
    }

    public function rab_client($id){
        $project = Rab::where(['project_id'=>$id])->get();
        $output = [];
        foreach($project as $item){
            $detail_rab = Detailrab::where(['rab_id'=>$item->id])->get();

            $output[] = [
                "master_rab" => $item,
                "detail_rab" => $detail_rab
            ];
        }

        $this->data['id'] = $id;
        $this->data['title'] = "Rab List";
        $this->data['output'] = $output;
        return view("content.project.rab_client",$this->data);
    }

    public function progress_client($id){
        $project = Rab::where(['project_id'=>$id])->get();
        $output = [];
        foreach($project as $item){
            $detail_rab = Detailprogress::where(['rab_id'=>$item->id])->get();

            $output[] = [
                "master_rab" => $item,
                "detail_rab" => $detail_rab
            ];
        }

        $this->data['id'] = $id;
        $this->data['title'] = "Rab List";
        $this->data['output'] = $output;
        return view("content.project.progress_client",$this->data);
    }

    public function progress_client_download($id){
        $project = Rab::where(['project_id'=>$id])->first();
        $detail_rab = Detailprogress::where(['rab_id'=>$project->id])->get();


        Excel::create('progress', function($excel) use($detail_rab,$project) {
            $excel->sheet('Sheet 1', function($sheet) use($detail_rab,$project) {
                $sheet->row(1,['Laporan Progress RAB']);
                $sheet->row(2,['No Project',':',$project->project->no_project]);
                $sheet->row(3,['No RAB',':',$project->no_rab]);
                $sheet->row(4,['Project Manager',':',$project->project->pm->name]);
                $sheet->row(5,['Client',':',$project->project->client->client->company_name]);
                $sheet->row(7,['Master Job','Job Item','Week','Progress','Start Date','End Date']);
                $start = 8;
                foreach($detail_rab as $k =>$val){
                    $sheet->row($start,[$val->detail_rab->master_job,$val->detail_rab->sub_job_name,$val->week_of,$val->progress.' %',$val->start_date,$val->end_date]);
                    $start++;
                }

//                $sheet->fromArray($detail_rab);
            });
        })->export('xls');
    }

    public function rab_client_download($id){
        $project = Rab::where(['project_id'=>$id])->first();
        $detail_rab = Detailrab::where(['rab_id'=>$project->id])->get();


        Excel::create('timeline', function($excel) use($detail_rab,$project) {
            $excel->sheet('Sheet 1', function($sheet) use($detail_rab,$project) {
                $sheet->row(1,['Laporan Timeline RAB']);
                $sheet->row(2,['No Project',':',$project->project->no_project]);
                $sheet->row(3,['No RAB',':',$project->no_rab]);
                $sheet->row(5,['Project Manager',':',$project->project->pm->name]);
                $sheet->row(5,['Client',':',$project->project->client->client->company_name]);
                $sheet->row(7,['Master Job','Job Item','Unit','Volume','Start Date','Estimate End Date','End Date','Reason Of Late','Progress','Status']);
                $start = 8;
                foreach($detail_rab as $k =>$val){
                    $sheet->row($start,[$val->master_job,$val->sub_job_name,$val->unit,$val->volume,$val->start_date,$val->estimate_end_date,$val->end_date,$val->late_reason,$val->last_progress.' %',($val->status_sub == 0) ? 'On Progress' : 'Finish']);
                    $start++;
                }

//                $sheet->fromArray($detail_rab);
            });
        })->export('xls');
    }


}
