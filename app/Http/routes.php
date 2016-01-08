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

Route::get('/', function () {
    return view('layouts.index');
});

/* Dash View Loader */

Route::get('dashboard', 'DashController@showDash');
Route::get('dashboard/index', 'DashController@index');

// Authentication Routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration Routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

/*Routing for Contracts Controller*/

Route::resource('contracts', 'ContractController', 
array('only' => array('index', 'create', 'show', 'store')));

/*Routing for File Controller*/

Route::resource('file', 'FileRecordController', 
	array('only' => array('store')));

Route::get('file/{id}', ['uses' => 'FileRecordController@create']);

//more tests
Route::get('signblob', 'SignatureController@blobSign');
Route::get('signdom', 'SignatureController@domSign');