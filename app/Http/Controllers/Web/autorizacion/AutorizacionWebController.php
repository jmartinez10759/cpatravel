<?php

namespace App\Http\Controllers\Web\autorizacion;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Web\MasterWebController;

class AutorizacionWebController extends MasterWebController
{


	/**
	 *Metodo Controller para obtener la pantalla de autorizacion
	 *@access public 
	 *@return void
	 */
	public function login_auth(){

		$id_solicitud = $this->parser_string();
		if (isset($id_solicitud['id_solicitud'])) {
			Session::put('id_solicitud',$id_solicitud['id_solicitud']);
		}else{
			return redirect( 'autorizacion?id_solicitud='.Session::get('id_solicitud') );
		}
		#unicamente se necesita el id de solicitud para hacer la consulta y mostrar los datos de esa solicitud
		if( Session::get('user_id') != NULL && Session::get('token') != NULL ){

			$url 		= 'http://52.44.90.182/api/userData';
			$headers 	= ['Content-Type' => 'application/json'];
			$data 		= ['token' => Session::get('token') ,'usuario' => Session::get('user_id') ];
			$method 	= 'post';
			$token 		= self::endpoint( $url,$headers,$data,$method );
			if ( isset($token->error) && $token->error == true ) {
                $logout =[
		            'user_id'
		            ,'token'
		            ,'id_solicitud'
		            ,'business_id'
		            ,'group_id'
		            ,'business_description'
		            ,'name'
		            ,'lastName'
		            ,'request_id'
		            ,'img'
		        ];
		        Session::forget($logout);
		        return redirect( 'autorizacion?id_solicitud='.Session::get('id_solicitud') );
            }

			$url 	= $this->_http.'://'.$this->_domain.'/api/travel/solicitudes?id_solicitud='.Session::get('id_solicitud');
			$headers 	= [
				'Content-Type'  => 'application/json'
            	,'usuario'      => Session::get('user_id')
            	,'token'        => Session::get('token')
        	];
			$data 		= [];
			$method 	= 'get';
			$response 	= self::endpoint($url,$headers,$data,$method);
			#debuger($response);
			$solicitudes = [];
			$viaticos = [];
			$montos = [];
			if ($response->success == true) {

				if ( count( $response->result ) > 0 ) {
					
					foreach ($response->result as $response) {
						
						$solicitudes = [

							'id_solicitud' 			=>  $response->id_solicitud
							,'fecha_inicio' 		=>  $response->solicitud_fecha_inicio
							,'fecha_fin' 			=>  $response->solicitud_fecha_fin
							,'horario_salida' 		=>  $response->solicitud_horario_inicio
							,'horario_regreso' 		=>  $response->solicitud_horario_fin
							,'destino_origen' 		=>  $response->solicitud_destino_inicio
							,'destino' 				=>  $response->solicitud_destino_final
							,'proyecto' 			=>  $response->proyecto
							,'subproyecto' 			=>  $response->subproyecto
							,'viajes' 				=>  $response->viaje
							,'total' 				=>  $response->total
							,'usuario' 				=>  $response->id_usuario
							,'acompanante' 			=>  ( isset($response->acompanantes->id_acompañante) )? implode(',',$response->acompanantes->id_acompañante ) : false
						];	
						
						if ( count($response->viaticos_detalles) > 0) {
							
							foreach ( $response->viaticos_detalles as $response ) {

								$viaticos[] = [
									'viatico' 					=> $response->viatico
									,'viatico_cantidad' 		=> $response->viatico_cantidad
									,'viatico_unidad' 			=> $response->viatico_unidad
									,'viatico_costo_unitario' 	=> $response->viatico_costo_unitario
									,'viatico_total' => format_currency($response->viatico_costo_unitario*$response->viatico_cantidad*$response->viatico_unidad)
								];

								if ( count( $response->montos_viaticos ) > 0) {

									foreach ( $response->montos_viaticos as $response ) {

										if ($response->monto_tipo_solicitud == "Nacional") {
											$montos[$response->monto_tipo_solicitud][] = [
												'monto_tipo_solicitud' 			=> $response->monto_tipo_solicitud
												,'monto_tipo_pago' 				=> $response->monto_tipo_pago
												,'monto_importe' 				=> $response->monto_importe
												,'monto_importe_autorizado' 	=> $response->monto_importe_autorizado

											];
											
										}
										if ($response->monto_tipo_solicitud == "Extranjero") {

											$montos[$response->monto_tipo_solicitud][] = [
												'monto_tipo_solicitud' 			=> $response->monto_tipo_solicitud
												,'monto_tipo_pago' 				=> $response->monto_tipo_pago
												,'monto_importe' 				=> $response->monto_importe
												,'monto_importe_autorizado' 	=> $response->monto_importe_autorizado

											];
										}

									}

								}

							}

							
						}



					}

					
				}


				$data = [
					'solicitudes'			=>	$solicitudes
					,'viaticos' 			=> 	$viaticos
					,'titulo_principal'		=>  'Autorizacion pendiente'
					,'logout'				=>  route('logout')
					,'autorizador'			=>  Session::get('name')
				];

				$cheques_nacional 			= 0;
				$debito_nacional 			= 0;
				$credito_nacional 			= 0;
				$efectivo_nacional 			= 0;
				$corporativa_nacional 		= 0;
				$total_nacional 			= 0;
				$cheques_extranjero 		= 0;
				$debito_extranjero 			= 0;
				$credito_extranjero 		= 0;
				$efectivo_extranjero 		= 0;
				$corporativa_extranjero 	= 0;
				$total_extranjero 			= 0;
				$nacional = 0;
				$extranjero = 0;
			if ( isset($montos['Nacional']) ) {
				$nacional = 1;
				foreach ($montos['Nacional'] as $response) {
					
					if ($response['monto_tipo_pago'] == 'Cheques') {
						$cheques_nacional += $response['monto_importe'];
					}
					if ($response['monto_tipo_pago'] == 'Debito') {
						$debito_nacional += $response['monto_importe'];	
					}
					if ($response['monto_tipo_pago'] == 'Credito') {
						$credito_nacional += $response['monto_importe'];
					}
					if ($response['monto_tipo_pago'] == 'Efectivo') {
						$efectivo_nacional += $response['monto_importe'];
					}
					if ($response['monto_tipo_pago'] == 'Corporativa') {
						$corporativa_nacional += $response['monto_importe'];
					}
					$total_nacional += $response['monto_importe'];
				}

			}

			if ( isset($montos['Extranjero']) ) {
				$extranjero = 1;
				foreach ($montos['Extranjero'] as $response) {
					
					if ($response['monto_tipo_pago'] == 'Cheques') {
						$cheques_extranjero += $response['monto_importe'];
					}
					if ($response['monto_tipo_pago'] == 'Debito') {
						$debito_extranjero += $response['monto_importe'];	
					}
					if ($response['monto_tipo_pago'] == 'Credito') {
						$credito_extranjero += $response['monto_importe'];
					}
					if ($response['monto_tipo_pago'] == 'Efectivo') {
						$efectivo_extranjero += $response['monto_importe'];
					}
					if ($response['monto_tipo_pago'] == 'Corporativa') {
						$corporativa_extranjero += $response['monto_importe'];
					}

					$total_extranjero += $response['monto_importe'];

				}

			}

				$data['total_nacional'] 			= format_currency($total_nacional);
				$data['cheques_nacional'] 			= format_currency($cheques_nacional);
				$data['debito_nacional'] 			= format_currency($debito_nacional);
				$data['credito_nacional'] 			= format_currency($credito_nacional);
				$data['efectivo_nacional'] 			= format_currency($efectivo_nacional);
				$data['corporativa_nacional'] 		= format_currency($corporativa_nacional);
				$data['total_extranjero'] 			= format_currency($total_extranjero);
				$data['cheques_extranjero'] 		= format_currency($cheques_extranjero);
				$data['debito_extranjero'] 			= format_currency($debito_extranjero);
				$data['credito_extranjero'] 		= format_currency($credito_extranjero);
				$data['efectivo_extranjero'] 		= format_currency($efectivo_extranjero);
				$data['corporativa_extranjero'] 	= format_currency($corporativa_extranjero);
				$data['nacional'] 					= $nacional;
				$data['extranjero'] 				= $extranjero;
				#debuger($data);
            	return view('autorizacion/page_auth',$data);

			}else{
				return view('autorizacion/login_auth');
			}

        }else{
          	return view('autorizacion/login_auth');
        }


	}
	/**
	 *Method para iniciar session de lado de autorizaciones
	 *@access public 
	 *@param Request $request
	 *@return void
	 */
	public function auth( Request $request ){

		try {
          /*  #$url= 'http://cpaaccess.cpalumis.com.mx/api/usuario/login';*/
            $url        = 'http://52.44.90.182/api/login';
            $headers    = ['Content-Type' => 'application/json'];
            $data       = ['email' => $request->email ,'password' => $request->password ,'servicio' =>7];
            $method     = 'post';
            $response   = self::endpoint($url,$headers,$data,$method);
            if ( isset( $response->sucess ) && $response->sucess == true) {
                $session = [
                    'user_id'   		=> $response->usuario[0]->usuario
                    ,'token'    		=> $response->token
                    ,'name'     		=> $response->usuario[0]->nombre
                ];
                Session::put($session);
                return redirect('autorizacion?id_solicitud='.Session::get('id_solicitud'));
            }
           return view('autorizacion/login_auth');

        } catch (\Exception $e) {
            dd($e->getMessage());
            dd('algo ocurrio');
        }

	}
	/**
	 *Metodo para validar la autorizacion si fue rechazada y/o aceptada con los montos...
	 *@access public
	 *@param Request $request [description]
	 *@return json
	 */
	public function validate_autorizacion( Request $request ){

		$nombres_montos = ['cheques','debito','credito','efectivo','corporativa'];
		$montos_autorizados_nacional   =  [];
		$montos_autorizados_extranjero =  [];
		for ($i=0; $i < count($request->montos_autorizados_nacional) ; $i++) { 
			$montos_autorizados_nacional[$nombres_montos[$i]] = $request->montos_autorizados_nacional[$i];
			$montos_autorizados_extranjero[$nombres_montos[$i]] = $request->montos_autorizados_extranjero[$i];
		}
		#se realiza la consulta para obtener todos los datos de la solicitud
		$url 	= $this->_http.'://'.$this->_domain.'/api/travel/solicitudes?id_solicitud='.$request->id_solicitud;
		$headers 	= [
			'Content-Type'  => 'application/json'
        	,'usuario'      => Session::get('user_id')
        	,'token'        => Session::get('token')
    	];
		$data 		= [];
		$method 	= 'get';
		$response 	= self::endpoint($url,$headers,$data,$method);

		$data = [
			#'solicitud' 		 => isset($response->result)? $response->result : []
			'id_solicitud' 		=> $request->id_solicitud
			,'montos_autorizados' => [
				'montos_autorizados_nacional' 		=> $montos_autorizados_nacional
				,'montos_autorizados_extranjero' 	=> $montos_autorizados_extranjero
			]
			,'estatus' => $request->estatus
			,'total_nacional_autorizado' 	=> str_replace(',', '', $request->total_nacional)
			,'total_extranjero_autorizado' => str_replace(',', '', $request->total_extranjero )
		];
		$url        = 'https://cpainbox.cpavision.mx/bpm/authorization/approve';
        $header    = ['Content-Type'  => 'application/json']; 
        $method     = 'post'; 
        $cpainbox   = self::endpoint($url,$header,$data,$method);
        if ($cpainbox->success == true) {
			return message( $cpainbox->success,[],'Transaccion exitosa' );
        }else{
        	return message(false,[],'Ocurrio un error');
        }


	}



}
