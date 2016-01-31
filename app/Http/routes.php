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

Route::get('/', 'HomeController@index');

/* Dash View Loader */

Route::get('dashboard', 'DashController@showDash');
Route::get('dashboard/index', 'DashController@index');

// Authentication Routes...
Route::get('auth/login/{provider?}', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
Route::get('auth/callback/{provider}', 'Auth\AuthController@handleProviderCallback');

// Registration Routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

//Add Address
Route::get('addaddress', 'Auth\AuthController@getAddAddress');
Route::post('addaddress', 'Auth\AuthController@postAddAddress');

/*Routing for Contracts Controller*/

Route::resource('contracts', 'ContractController', 
array('only' => array('index', 'create', 'show', 'store')));

/*Routing for File Controller*/

Route::resource('file', 'FileRecordController', 
	array('only' => array('store')));

Route::get('file/{id}', ['uses' => 'FileRecordController@create']);

/*Routing for Signature Record Controller*/

Route::get('signeerecord/{id}', ['uses' => 'SigneeRecordController@create']);
Route::post('signeerecord', ['uses' => 'SigneeRecordController@store']);

//more tests
Route::get('signblob', 'SignatureTestController@blobSign');
Route::get('signdom', 'SignatureTestController@domSign');