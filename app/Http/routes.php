<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();
Route::get('test',function(){
	return Nomor::getNomor("project","no_project","PRJ");
});
Route::get('/','Auth\AuthController@showLoginForm');

Route::group(['middleware'=>['auth']],function(){
	Route::get('home','HomeController@index');

	//User
	Route::get('user','UserController@index');
	Route::get('user/show/{id}/{nama}','UserController@show');
	Route::get('user/create','UserController@create');
	Route::post('user/save','UserController@save');
	Route::get('user/edit/{id}/{nama}','UserController@edit');
	Route::put('user/update/{id}','UserController@update');
	Route::delete('user/delete/{id}','UserController@delete');

	//client
	Route::get('client','ClientController@index');
	Route::get('client/show/{id}/{nama}','ClientController@show');
	Route::get('client/edit/{id}/{nama}','ClientController@edit');
	Route::put('client/update/{id}','ClientController@update');
	Route::delete('client/delete/{id}','ClientController@delete');

	//Master Job
	Route::get('master-job','MpController@index');
	Route::get('master-job/show/{id}/{nama}','MpController@show');
	Route::get('master-job/create','MpController@create');
	Route::post('master-job/save','MpController@save');
	Route::get('master-job/edit/{id}/{nama}','MpController@edit');
	Route::put('master-job/update/{id}','MpController@update');
	Route::delete('master-job/delete/{id}','MpController@delete');

	//project
	Route::get('project','ProjectController@index');
	Route::get('project/create','ProjectController@create');
	Route::post('project/save','ProjectController@save');;
	Route::get('project/edit/{id}/{nama}','ProjectController@edit');
	Route::put('project/update/{id}','ProjectController@update');
	Route::patch('project/patch/{id}','ProjectController@patch');
	Route::delete('project/delete/{id}','ProjectController@delete');
	Route::get('project/get-detail-user/{id}','ProjectController@get_detail_user');
	Route::get('project/detail/{id}','ProjectController@get_detail_project');
	Route::get('project/get-detail-project/{id}','ProjectController@get_project_by_id');

	//rab
	Route::get('rab','RabController@index');
	Route::get('rab/create','RabController@create');
	Route::post('rab/save','RabController@save');;
	Route::get('rab/edit/{id}','RabController@edit');
    Route::get('rab/timeline_rab/{id}','RabController@timeline');
    Route::get('rab/progress_rab/{id}','RabController@progress');
    Route::get('rab/progress/week/{week}/{id}','RabController@detail_progress');
    Route::get('rab/edit/{id}','RabController@edit');
	Route::put('rab/update/{id}','RabController@update');
    Route::put('rab/update_timeline/{id}','RabController@update_timeline');
    Route::post('rab/insert_progress','RabController@insert_progress');
    Route::put('rab/update_progress/{id}','RabController@update_progress');
    Route::put('rab/update_progress_week/{id}','RabController@update_progress_week');
	Route::delete('rab/delete/{id}','RabController@delete');
	Route::get('rab/get-detail-user/{id}','RabController@get_detail_user');
	Route::get('rab/detail/{id}','RabController@get_detail_project');


    //client
    Route::get('project/client/{id}','ProjectController@client');
    Route::get('project/rab/{id}','ProjectController@rab_client');
    Route::get('project/rab/{id}/download','ProjectController@rab_client_download');
    Route::get('project/progress/{id}','ProjectController@progress_client');
    Route::get('project/progress/{id}/download','ProjectController@progress_client_download');
});