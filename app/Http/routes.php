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

/*Routing for Intellectual Property*/

Route::get('ip/create', function () {
    return redirect()->route('contracts.create', [2]);
});
Route::get('ip/index', function () {
    return redirect()->route('contracts.index', [2]);
});

/*Routing for Contracts Controller*/

Route::resource('contracts', 'ContractController', 
array('only' => array('edit', 'store', 'show')));
Route::get('contracts/create/{type?}', ['as' => 'contracts.create', 'uses' => 'ContractController@create']);
Route::get('contracts/index/{type?}', ['as' => 'contracts.index', 'uses' => 'ContractController@index']);
Route::post('contracts/{id}', ['uses' => 'ContractController@update']);

/*Routing for templates*/
Route::resource('templates', 'TemplateController', 
array('only' => array('index','create' ,'edit', 'store', 'show')));

/*Routing for File Controller*/

Route::resource('file', 'FileRecordController', 
	array('only' => array('store')));

Route::get('file/{id}', ['uses' => 'FileRecordController@create']);
Route::get('file/{id}/delete', ['uses' => 'FileRecordController@destroy']);

/*Routing for Signature Records*/

Route::get('contract/{id}/signees', ['uses' => 'SignatureController@create']);
Route::post('addsignee', ['uses' => 'SignatureController@store']);
Route::get('signee/{id}/delete', ['uses' => 'SignatureController@destroy']);

/*Routing for Key Controller*/
Route::get('createkey/{contract_id}', 'KeyController@create');
Route::post('createkey', 'KeyController@store');

/*Routing for Signature Controller*/
Route::post('sign', 'SignatureController@postSign');
Route::get('signatures/{status}', 'SignatureController@index');

//more tests
Route::get('signblob', 'SignatureTestController@blobSign');
Route::get('signdom', 'SignatureTestController@domSign');