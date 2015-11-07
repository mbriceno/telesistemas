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
    return view('welcome');
});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('profile', ['middleware' => 'auth', function() {
    // Only authenticated users may enter...
}]);

Route::group(array('prefix' => 'admin'), function(){
	Route::any('/',array('as'=>'admin','uses' => 'AdminController@index'));
	Route::resource('rubro', 'RubroController');
	Route::resource('empresa', 'EnterpriseController');
	Route::resource('plan', 'PlanController');
	Route::resource('representante', 'RepresentativeController');
});