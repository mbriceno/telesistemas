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

// Display all SQL executed in Eloquent
/*Event::listen('illuminate.query', function($query){
	var_dump($query);
});*/

Route::get('/', function () {
    return view('welcome');
});

// Authentication routes...
Route::get('/', 'Auth\AuthController@getLogin');
Route::post('/auth/login', 'Auth\AuthController@authenticate');
Route::get('auth/logout', 'Auth\AuthController@getLogout')->name('logout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('profile', ['middleware' => 'auth', function() {
    // Only authenticated users may enter...
}]);

Route::group(array('prefix' => 'admin', 'middleware' => ['auth']), function(){
	Route::any('/',array('as'=>'admin',
							'middleware' => ['level:20'],
							'uses' => 'AdminController@index'));
	
	Route::resource('rubro', 'RubroController');
	Route::resource('empresa', 'EnterpriseController');
	Route::resource('plan', 'PlanController');
	Route::resource('representante', 'RepresentativeController');
	Route::resource('bancos', 'BankController');
	Route::resource('cuentas_bancarias', 'BankAccountController');

	Route::get('empresa/staff/{id}', 
				array('as'=>'admin.empresa.staff', 
						'uses' => 'UserEnterpriseController@staff'));
	Route::get('usuarios_empresa/create_user/{id}', 
				array('as'=>'admin.usuarios_empresa.create_user',
						'uses' => 'UserEnterpriseController@create_user'));
	Route::resource('usuarios_empresa', 'UserEnterpriseController');

	Route::get('pagos/listado/{id}', array('as'=>'admin.pagos.listado','uses' => 'PaymentOrderController@payment_list'));
	Route::get('pagos/nuevo-pago/{id}', array('as'=>'admin.pagos.create_payment','uses' => 'PaymentOrderController@create_payment'));
	Route::resource('pagos', 'PaymentOrderController');

	Route::get('pagos-transaccion/nuevo-pago/{id}', 
				array('as'=>'admin.pagos-transaccion.payment_record',
						'uses' => 'PaymentTransactionController@payment_record'));
	Route::resource('pagos-transaccion', 'PaymentTransactionController');

	Route::get('reportes/planes', array('as'=>'admin.reportes.planes','uses' => 'ReportController@planes'));
	Route::get('reportes/ventas', array('as'=>'admin.reportes.ventas','uses' => 'ReportController@ventas'));
	Route::get('reportes/ventas/excel', array('as'=>'admin.reportes.ventas.excel','uses' => 'ReportController@ventas_a_excel'));
	Route::resource('reportes', 'ReportController');

	Route::get('pagos-empresas/listado/{id}', array('as'=>'admin.pagos-empresas.listado','uses' => 'DebitOrderController@debit_list'));
	Route::get('pagos-empresas/nuevo-debito/{id}', array('as'=>'admin.pagos-empresas.create_debit','uses' => 'DebitOrderController@create_debit'));
	Route::resource('pagos-empresas', 'DebitOrderController');
});

Route::group(array('prefix' => 'sale-point', 'middleware' => ['auth','role:empresas.vendedor|empresas.administrador']), function(){
	Route::any('/',array('as'=>'sale-point','uses' => 'SalePointController@index'));
	Route::get('orden-venta/pago-paso1', array('as'=>'sale-point.orden-venta.pago-paso1',
									'uses' => 'SaleOrderController@payment_step1'));
	Route::resource('orden-venta', 'SaleOrderController');
});
