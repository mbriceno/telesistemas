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
Route::post('auth/login', 'Auth\AuthController@authenticate');
Route::get('auth/logout', 'Auth\AuthController@getLogout')->name('logout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('profile', ['middleware' => 'auth', function() {
    // Only authenticated users may enter...
}]);

Route::group(array('prefix' => 'admin', 'middleware' => ['auth','level:90']), function(){
	Route::any('/',array('as'=>'admin','uses' => 'AdminController@index'));
	Route::resource('rubro', 'RubroController');
	
	Route::get('empresa/staff/{id}', array('as'=>'admin.empresa.staff','uses' => 'EnterpriseController@staff'));
	Route::resource('empresa', 'EnterpriseController');
	Route::resource('plan', 'PlanController');
	Route::resource('representante', 'RepresentativeController');
	Route::resource('bancos', 'BankController');
	Route::resource('cuentas_bancarias', 'BankAccountController');

	Route::get('usuarios_empresa/create_user/{id}', array('as'=>'admin.usuarios_empresa.create_user','uses' => 'UserEnterpriseController@create_user'));
	Route::resource('usuarios_empresa', 'UserEnterpriseController');
});

Route::group(array('prefix' => 'sale-point', 'middleware' => ['auth','role:empresas.vendedor']), function(){
	Route::any('/',array('as'=>'sale-point','uses' => 'SalePointController@index'));
	Route::resource('orden-venta', 'SaleOrderController');
});