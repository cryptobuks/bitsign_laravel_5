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

Route::get('/', 'ViewController@loadView');

/* Dash View Loader */

Route::get('home', 'ViewController@home');

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

/*Routing for Signature Controller*/
Route::post('sign', 'SignatureController@postSign');
Route::get('signatures/{status}', 'SignatureController@index');

/*
|--------------------------------------------------------------------------
| Material Dash Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/home', function () {
//     return view('home');
// });

Route::get('/login', function () {
    return view('pages.login');
});

Route::get('/signup', function () {
    return view('pages.signup');
});

Route::get('/404', function () {
    return view('pages.404');
});

Route::get('/blank', function () {
    return view('pages.blank');
});

Route::get('/calendar', function () {
    return view('pages.calendar');
});

Route::get('/profile', function () {
    return view('pages.profile');
});

Route::get('/inbox', function () {
    return view('pages.inbox');
});

Route::get('/invoice', function () {
    return view('pages.invoice');
});

Route::get('/ui-elements/button', function () {
    return view('pages.button');
});

Route::get('/badge', function () {
    return view('pages.badge');
});

Route::get('/ui-elements/card', function () {
    return view('pages.card');
});

Route::get('/charts/c3chart', function () {
    return view('pages.c3chart');
});

Route::get('/charts/chartjs', function () {
    return view('pages.chartjs');
});

Route::get('/grid', function () {
    return view('pages.grid');
});

Route::get('/ui-elements/components', function () {
    return view('pages.components');
});

Route::get('/form', function () {
    return view('pages.form');
});

Route::get('/docs', function () {
    return view('pages.docs');
});

Route::get('api/change-theme', function() {
    \Session::set('theme', \Input::get('theme'));
});

 Route::get('api/change-layout', function() {
    \Session::set('layout', \Input::get('layout'));
});

Route::get('api/lang', function() {
    \Session::set('lang', \Input::get('lang'));
});

Route::get('api/set-rtl', function() {
    \Session::set('rtl', \Input::get('rtl'));
});