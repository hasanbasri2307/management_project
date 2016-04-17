<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ClientRequest;
use App\Client;
use Session;

class ClientController extends Controller
{
    //
    private $data;

    public function index(){
    	$client = client::all();
    	$this->data['client'] = $client;
    	$this->data['title'] = "Client";
    	return view("content.admin.client.list",$this->data);
    }

    public function edit($id,$name){
    	$client = client::find($id);
    	$name = $client->user->name;
    	$this->data['client'] = $client;
    	$this->data['title'] = "Client Edit ($client->id - $name)";
    	return view("content.admin.client.edit",$this->data);
    }

    public function update(clientRequest $request,$id){
    	$client = client::find($id);
    	$client->company_name = $request->company_name;
    	$client->phone = $request->phone;
    	$client->address = $request->address;
    	$client->save();

    	Session::flash('success','Client has been updated');
    	return redirect('client');
    }

    public function delete($id){
    	$client = client::find($id);
    	$client->delete();

    	Session::flash('success','Client has been deleted');
    	return redirect('client');
    }
}
