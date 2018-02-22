<?php



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login','Auth\LoginController@login');
Route::post('prueba','HomeController@prueba')->name('token');

/**
 *Se crean las rutas respectivas 2017-11-16
 */

	############################ API LOGIN #################################
	Route::post('access/auth','Apirest\LoginController@auth');

	############################ API EMPRESAS #################################

	Route::post('access/business','Apirest\EmpresaController@business');

	############################ API PERMISOS #################################

	Route::post('access/permission','Apirest\PermisoController@permission');

	############################ API TOKEN #################################

	Route::post('access/token','Apirest\ValidateTokenController@token');
	Route::post('access/valiatetoken','Apirest\ValidateTokenController@tokenweb');

	############################ API PROYECTOS #################################
	
	Route::get('travel/proyecto{?}','Apirest\ProyectosController@index');
	Route::get('travel/proyecto','Apirest\ProyectosController@index');
	Route::post('travel/proyecto','Apirest\ProyectosController@index');
	Route::put('travel/proyecto','Apirest\ProyectosController@index');
	Route::delete('travel/proyecto','Apirest\ProyectosController@index');
	
	############################ API SUBPROYECTOS #################################
	
	Route::get('travel/subproyectos{?}','Apirest\SubProyectosController@index');
	Route::get('travel/subproyectos','Apirest\SubProyectosController@index');
	Route::post('travel/subproyectos','Apirest\SubProyectosController@index');
	Route::put('travel/subproyectos','Apirest\SubProyectosController@index');
	Route::delete('travel/subproyectos','Apirest\SubProyectosController@index');
	
	############################ API VIAJES #################################
	
	Route::get('travel/viajes{?}','Apirest\ViajesController@index');
	Route::get('travel/viajes','Apirest\ViajesController@index');
	Route::post('travel/viajes','Apirest\ViajesController@index');
	Route::put('travel/viajes','Apirest\ViajesController@index');
	Route::delete('travel/viajes','Apirest\ViajesController@index');
	
	############################ API RELACION #################################
	
	Route::get('travel/relations/{?}','Apirest\RelUsuarioProyectoController@index');
	Route::get('travel/relations','Apirest\RelUsuarioProyectoController@index');
	Route::post('travel/relations','Apirest\RelUsuarioProyectoController@index');
	Route::put('travel/relations','Apirest\RelUsuarioProyectoController@index');
	Route::delete('travel/relations','Apirest\RelUsuarioProyectoController@index');
	
	############################ API POLITICAS  #################################

	Route::get('travel/politicas{?}','Apirest\PoliticaController@index');
	Route::get('travel/politicas','Apirest\PoliticaController@index');
	Route::post('travel/politicas','Apirest\PoliticaController@index');
	Route::put('travel/politicas','Apirest\PoliticaController@index');
	Route::delete('travel/politicas','Apirest\PoliticaController@index');
	
	############################ API ETIQUETAS  #################################
	
	Route::get('travel/etiquetas{?}','Apirest\EtiquetaController@index');
	Route::get('travel/etiquetas','Apirest\EtiquetaController@index');
	Route::post('travel/etiquetas','Apirest\EtiquetaController@index');
	Route::put('travel/etiquetas','Apirest\EtiquetaController@index');
	Route::delete('travel/etiquetas','Apirest\EtiquetaController@index');

	############################ API SOLICITUDES  #################################
	
	Route::get('travel/solicitudes{?}','Apirest\SolicitudController@index');
	Route::get('travel/solicitudes','Apirest\SolicitudController@index');
	Route::post('travel/solicitudes','Apirest\SolicitudController@index');
	Route::put('travel/solicitudes','Apirest\SolicitudController@index');
	Route::delete('travel/solicitudes','Apirest\SolicitudController@index');
	
	############################ API COMPROBANTE CFDI #################################
	
	Route::get('travel/comprobantes{?}','Apirest\ComprobanteApiController@index');
	Route::get('travel/comprobantes','Apirest\ComprobanteApiController@index');
	Route::post('travel/comprobantes','Apirest\ComprobanteApiController@index');
	Route::put('travel/comprobantes','Apirest\ComprobanteApiController@index');
	Route::delete('travel/comprobantes','Apirest\ComprobanteApiController@index');

	############################ API CONCEPTOS CFDI #################################
	
	Route::get('travel/conceptos{?}','Apirest\ComprobanteDetalleApiController@index');
	Route::get('travel/conceptos','Apirest\ComprobanteDetalleApiController@index');
	Route::post('travel/conceptos','Apirest\ComprobanteDetalleApiController@index');
	Route::put('travel/conceptos','Apirest\ComprobanteDetalleApiController@index');
	Route::delete('travel/conceptos','Apirest\ComprobanteDetalleApiController@index');

#api anterior
/*Route::group(['middleware' => ['token']], function () {
    Route::resource('travel','Api\TravelController');
    Route::resource('project','Api\ProjectController');
    Route::resource('subproject','Api\SubProjectController');
    Route::get('projects','Api\ProjectExtendController@projects');
});*/


