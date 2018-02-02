<?php


Auth::routes();
Route::get('/', 'HomeController@index')->name('beginin');
Route::post('/home', 'AuthController@store')->name('auth.store');
#Route::post('/home', 'LoginController@login')->name('auth.store');
#Route::get('/func', 'PruebaController@func');

Route::group(['middleware' => ['auth.session']], function () {

    Route::get('/home', 'AuthController@index')->name('auth.index');
    /* Fin de rutas  de menus*/
    Route::get('list/project','ProjectExtendController@list_project')->name('list_project');

    Route::get('autocomplete/project','ProjectExtendController@searchProject')->name('autocomplete_project');
    Route::get('autocomplete/subproject','SubProjectExtendController@searchSubProject')->name('autocomplete_subproject');
    Route::get('autocomplete/travel','TravelExtendController@searchTravel')->name('autocomplete_travel');

    Route::get('autocomplete/project/account','ProjectExtendController@searchProjectAccount')->name('autocomplete_project_acount');
    Route::get('autocomplete/subproject/account','SubProjectExtendController@searchSubProjectAccount')->name('autocomplete_subproject_acount');
    Route::get('autocomplete/travel/account','TravelExtendController@searchTravelAccount')->name('autocomplete_travel_acount');

    Route::resource('subproject','SubProjectWebController');
    Route::resource('travel','TravelWebController');
    Route::resource('label','LabelWebController');

/*
    Route::get('prueba/search','PruebaController@search')->name('search');
    Route::get('autocomplete','PruebaController@autocomplete')->name('autocomplete');

    Route::get('detail/label','LabelExtendController@detail')->name('label_detail');

    Route::get('request','RequestController@create')->name('request_create');
    Route::get('request/update','RequestController@update')->name('update_create');
    Route::get('lodging/create','LodgingTagController@create')->name('lodging_create');
    Route::get('food/create','FoodTagController@create')->name('food_create');
    Route::get('mileage/create','MileageTagController@create')->name('mileage_create');
    Route::get('air/create','AirTagController@create')->name('air_create');
    Route::get('land/create','LandTagController@create')->name('land_create');
    Route::get('rentcar/create','RentCarTagController@create')->name('rent_cart_create');
    Route::get('seminar/create','SeminarTagController@create')->name('seminar_create');
    Route::get('taxi/create','TaxiTagController@create')->name('taxi_create');
    Route::get('pending/detail/{iden}','RequestController@detail')->name('detail_pending');*/



    Route::get('user/search','AuthController@autocompletSearch')->name('search_users');
    Route::get('country/search','ContryController@searchCountry')->name('search_country');
    Route::get('city/search','CityCodeController@searchCity')->name('search_city');
    Route::get('city/autocomplete','CityCodeController@autocomplete')->name('auto_search_city');

    Route::get('country/search_2','ContryController@searchCountry_2')->name('search_country_2');
    Route::get('city/search_2','CityCodeController@searchCity_2')->name('search_city_2');
    Route::get('city/autocomplete_2','CityCodeController@autocomplete_2')->name('auto_search_city_2');

    Route::get('money/authorization','RequestController@moneyAuthorization')->name('money_authorization');



});

    ####################### SECCCION DE LOGOUT ########################
    #ruta para desloguear al usuario
    Route::get('auth/logout','AuthController@logout')->name('logout');
    ####################### SECCCION DE LISTADO DE EMPRESA ########################
    #muestra la ruta de las empresas del usuario
    Route::get('list/business','BusinessController@lista')->name('list');
    ####################### SECCCION DE EMPRESAS ########################
    #manda a session las variables de la empresa
    Route::get('generate/business','BusinessController@generateBusiness')->name('busine_select');

    ####################### SECCCION DE MENU PRICIPAL ########################
    #rutas principales de la vista principal y menu principal.

    Route::get('business/process','RoutingController@businessProcess')->name('business_process');
    Route::get('authorization','RoutingController@viaje_authorization')->name('authorization_travel');
    Route::get('policies','RoutingController@policies')->name('policies');
    Route::get('pending','RoutingController@pending')->name('pending');
    Route::get('account/status','RoutingController@accountStatus')->name('account_status');
    Route::get('registration/conciliation','RoutingController@registrationConciliation')->name('registration_conciliation');
    

    ####################### SECCCION DE SOLICITUD DE VIAJE ########################
    #se crea la ruta de la solicitud de viaje crud
    Route::get('solicitud','Web\SolicitudViajeController@index')->name('solicitud_viaje');
    Route::get('solicitud/pendientes','Web\SolicitudViajeController@solicitudes_pendientes')->name('solicitud_viaje_pendiente');
    Route::get('solicitud/filtro','Web\SolicitudViajeController@filtro_estatus')->name('filtro_estatus');
    Route::post('solicitud/guardar','Web\SolicitudViajeController@save_solicitud')->name('solicitud_carga_solicitud');
    Route::post('solicitud/save','Web\SolicitudViajeController@save_viaticos_solicitud')->name('save_viaticos_solicitud');
    Route::post('solicitud/particular','Web\SolicitudViajeController@show_register_solicitud')->name('solicitud_show_solicitud');
    Route::get('solicitud/consulta','Web\SolicitudViajeController@consulta_solicitud')->name('consulta_solicitud');
    Route::post('solicitud/cancel','Web\SolicitudViajeController@cancel_solicitud')->name('cancel');

    ####################### SECCCION DE SOLICITUDES PENDIENTES  ########################
    Route::get('pendientes','Web\PendientesWebController@index')->name('pendientes');

    ####################### SECCCION DE ESTADOS DE CUENTA  ########################
    Route::get('estadoscuenta','Web\estado_cuenta\EstadoCuentaWebController@index')->name('estadoscuenta');
    Route::get('estadoscuenta/filtros','Web\estado_cuenta\EstadoCuentaWebController@filtros')->name('filtros');


    ####################### SECCCION DE PROYECTOS, SUBPROYECTOS Y VIAJES ########################

    #se crea el crud del controller project
    Route::get('proyecto','ProyectoWebController@index')->name('create_project');
    Route::get('proyecto/showById','ProyectoWebController@showById')->name('proyectosById');
    Route::post('proyecto/create','ProyectoWebController@create')->name('create_proyectos');
    Route::post('proyecto/actualizar','ProyectoWebController@actualizar')->name('update_proyectos');
    #ruta para subproyectos
    Route::get('subproyectos','SubProyectoWebController@index')->name('subproyectos');
    Route::get('subproyectos/subproyectobyid','SubProyectoWebController@show_subproyectos')->name('show_subproyectos');
    Route::post('subproyectos/create','SubProyectoWebController@create')->name('create_subproyectos');
    Route::post('subproyectos/actualizar','SubProyectoWebController@actualizar')->name('update_subproyectos');
    #ruta de viajes
    Route::get('viajes','ViajeWebController@show')->name('show_viajes');
    Route::get('viajes/viajebyid','ViajeWebController@show_by_id')->name('show_by_id');
    Route::post('viajes','ViajeWebController@create')->name('create_viajes');
    Route::post('viajes/actualizar','ViajeWebController@actualizar')->name('update_viajes');

    ####################### SECCCION DE VIATICOS ########################
    #busqueda de proyectos
    Route::get('search','ProjectExtendController@search')->name('search_project');
    #rutas para la visualizacion de los viaticos de cada seccion
    Route::get('viaticos/consulta','Web\ViaticoDetalleWebController@main')->name('viaticos');
    Route::post('viaticos/create','Web\ViaticoDetalleWebController@guardar')->name('save_viaticos');
    Route::get('viaticos/detalles','Web\ViaticoDetalleWebController@detalles')->name('detalles');
    Route::post('viaticos/borrar','Web\ViaticoDetalleWebController@borrar')->name('borrar');
    Route::post('viaticos/actualizar','Web\ViaticoDetalleWebController@actualizar')->name('actualizar');

    ####################### SECCCION DE POLITICAS ########################
    
    ######## Etiqueta politica ###########
    Route::get('politicas','Web\etiquetas_politicas\EtiquetaWebController@index')->name('etiquetas_politicas');
    Route::post('politicas/guardar','Web\etiquetas_politicas\EtiquetaWebController@save_etiquetas')->name('save_etiquetas');
    Route::get('politicas/detalles','Web\etiquetas_politicas\EtiquetaWebController@detalles_politicas')->name('detalles_politicas');
    Route::post('politicas/actualizacion','Web\etiquetas_politicas\EtiquetaWebController@actualizacion_politicas')->name('actualizacion_politicas');
    Route::post('politicas/eliminar','Web\etiquetas_politicas\EtiquetaWebController@eliminar_politicas')->name('eliminar_politicas');
    Route::post('politicas/upload','Web\etiquetas_politicas\EtiquetaWebController@upload')->name('upload');

    ####################### SECCCION DE AUTORIZACION ########################
    Route::get('autorizacion/{id_solicitud?}','Web\autorizacion\AutorizacionWebController@login_auth')->name('autorizacion');
    Route::post('autorizacion','Web\autorizacion\AutorizacionWebController@auth')->name('page_auth');
    Route::post('autorizacion/enviar','Web\autorizacion\AutorizacionWebController@validate_autorizacion')->name('validate_autorizacion');

    ####################### SECCCION DE COMPROBANTES CFDI ########################

    Route::get('comprobantes/menus','RoutingController@comprobantes')->name('comprobantes_menus');
    Route::get('comprobantes/register','Web\comprobantes\ComprobanteController@register')->name('comprobante_regiter');
    Route::get('comprobantes/busqueda','Web\comprobantes\ComprobanteController@busqueda')->name('comprobante_busqueda');
