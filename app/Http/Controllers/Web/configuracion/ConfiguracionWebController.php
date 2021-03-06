<?php

namespace App\Http\Controllers\Web\configuracion;

use App\Model\MasterModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Web\MasterWebController;

class ConfiguracionWebController extends MasterWebController
{
    
    public function __construct(){
        
        parent::__construct();
        $this->session_expire();

    }
	/**
	 *Metodo controller donse se carga la vista de la carga de la factura
	 *@access public
	 *@return void
	 */
	public function index(){

		if ($this->_tipo_user != 21) {
			echo "<script> buildSweetAlert('Permiso Denegado','No Cuenta con permisos para ingresar','error');</script>";die();
		}
		return $this->store_autorizacion();
		$url = "https://cpainbox.cpavision.mx/bpm/authorization/getRules/";
        $headers = [ 'Content-Type'  => 'application/json'];
        $data=['empresa' => Session::get('business_id'),'proceso' => 'x'];
        $method = 'post';
        $autorizaciones = self::endpoint($url,$headers,$data,$method);
        debuger($autorizaciones);
		

	}
	/**
     *Metodo crear los grupos de los autorizadores
	 *@access public
	 *@return void
	 */
	public function store_autorizacion(){

		$url = "http://52.44.90.182/system/getUsersByEmpresa";
        $headers = [ 'Content-Type'  => 'application/json'];
        $data=['empresa' => Session::get('business_id')];
        $method = 'post';
        $empleados = self::endpoint($url,$headers,$data,$method);

		$data = [
    		'titulo_principal' => "Configuracion de Autorizadores"
    		,'usuario'         => Session::get('name')
            ,'avatar'          => ( !is_null(Session::get('img') ) )? Session::get('img') : asset('images/avatar.jpeg')
            ,'empleados' 		=> isset( $empleados->rows )? $empleados->rows : []
    	];
    	#debuger( $data );
		return view('process_bussines.configuracion.configuracion_auth',$data);

	}
	/**
	 *Metodo para  guardar los cambios de autorizaciones
	 *@access public
	 *@param Request $request [description]
	 *@return json
	 */
	public function create_configuracion( Request $request ){
		
		if ( count( $request->autorizadores ) == 0 || count($request->empleados) == 0 ) {
			return message(false,[],"Asigna los autorizadores");
		}
		#$autorizador = explode('|', $request->id_autorizador);
		$data = [
			'importe' 			=> $request->importe
			,'autorizadores' 	=> $request->autorizadores
			,'empleados' 	 	=> $request->empleados
		];
		$result = [
			'empresa'	=> Session::get('business_id')
			,'proceso' 	=> 'x'
			,'stage' 	=> 0
			,'rules'    => $data
		];
		
		$url 		=  "https://cpainbox.cpavision.mx/bpm/authorization/save";
		$headers 	=  [ 'Content-Type'  => 'application/json'];
		$datos  	=  $result;
		$method 	= 'post'; 
		$response   = self::endpoint($url,$headers,$datos,$method);
		if ($response->success == true) {
			return message($response->success,$datos,"Transaccion Exitosa");
		}
		
	}


}
