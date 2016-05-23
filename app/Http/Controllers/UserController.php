<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\User;
use App\Client;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    //
    private $data;

    public function index(){
    	$user = User::all();
    	$this->data['user'] = $user;
    	$this->data['title'] = "User";
    	return view("content.master.user.list",$this->data);
    }

    public function create(){
    	$this->data['title'] = "User Create";
    	return view("content.master.user.create",$this->data);
    }

    public function save(UserRequest $request){
    	$user = new User();
    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->password = bcrypt($request->password);
    	$user->role = $request->role;
        $user->status_user = $request->status_user;
    	$user->save();

        if($request->role == "client"){
            $client = new Client();
            $client->user_id = $user->id;
            $client->save();
        }

    	Session::flash('success','User has been created');
    	return redirect('user');
    }

    public function edit($id,$name){
    	$user = User::find($id);
    	$this->data['user'] = $user;
    	$this->data['title'] = "User Edit ($user->id - $user->name)";
    	return view("content.master.user.edit",$this->data);
    }

    public function update(UserRequest $request,$id){
    	$user = User::find($id);
    	$user->name = $request->name;
    	$user->role = $request->role;
        $user->status_user = $request->status_user;
    	$user->save();

    	Session::flash('success','User has been updated');
    	return redirect('user');
    }

    public function delete($id){
    	$user = User::find($id);
    	$user->delete();

    	Session::flash('success','User has been deleted');
    	return redirect('user');
    }
}
