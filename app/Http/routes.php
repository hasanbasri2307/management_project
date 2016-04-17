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

	//project
	Route::get('project','ProjectController@index');
	Route::get('project/create','ProjectController@create');
	Route::post('project/save','ProjectController@save');
	Route::get('project/show/{id}/{nama}','ProjectController@show');
	Route::get('project/edit/{id}/{nama}','ProjectController@edit');
	Route::put('project/update/{id}','ProjectController@update');
	Route::delete('project/delete/{id}','ProjectController@delete');
	Route::get('project/get-detail-user/{id}','ProjectController@get_detail_user');
});