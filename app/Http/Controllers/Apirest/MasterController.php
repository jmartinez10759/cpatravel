<?php

namespace App\Http\Controllers\Apirest;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
#use App\Http\Controllers\Apirest\CurlRequestController;

class MasterController extends Controller
{
	protected $_api; #propiedad
    protected $_permission; #propiedad
    protected $_url;
    protected $tipo = "application/json";
    public $_client;

    public function __construct(){
        $this->_client = new Client();
    }
     /**
     *Metodo para la validacion del token
     *@access public
     *@param array
     *@return 
     */
    public function validate_permisson( $indice = false ,$parametros = array(),$request=false ){
        #indice = id_de la tabla
        $datos          = self::parser_string();
        $server         = $_SERVER['REQUEST_METHOD'];
        $http_usuario   = isset( $_SERVER['HTTP_USUARIO'] )? $_SERVER['HTTP_USUARIO']:"";
        $http_token     = isset( $_SERVER['HTTP_TOKEN'] )? $_SERVER['HTTP_TOKEN']:"";

        if ($http_token && $http_usuario) {
            $token = self::token_validate([ 'usuario' => $http_usuario,'token' => $http_token]);
        }else{
            $token = false;
        }
    	$permisson = self::permisson_validate();
        if ( isset($token->success) && $token->success == true ) {            
            switch ($server) {
                case 'GET':
                    if ( in_array( $permisson, [21,19] )  ) {
                        if ( isset($parametros[$indice]) ) {
                            return $this->show( $parametros );
                        }
                        if (isset($datos) && count($datos) > 0) {
                            return $this->show( $datos );
                        }
                            return $this->all();
                    }
                    	return $this->show_error(0);
                    break;
                
                case 'POST':
                    if ( in_array( $permisson, [21,45]  ) ){
                        return $this->create($request);
                    }
		    			return $this->show_error(0);
                    break;
                case 'PUT':
                        $id = isset($request->data[$indice])? $request->data[$indice] :"";
                        if ( in_array( $permisson, [21,44]  ) ) {
                            return $this->update($request->data,$id);
                        }
						return $this->show_error(0);
                    break;
                case 'DELETE':
                        $id = isset($request->data[$indice])? $request->data[$indice] :"";
                        if ( in_array( $permisson, [21]  ) ){
                            return $this->destroy($id);
                        }
						return $this->show_error(0);
                    break;
                
            }

        }

        return $this->show_error(1); 
    
    }
     /**
     *Metodo para la validacion del token
     *@access protected
     *@param array
     *@return 
     */
    protected  function token_validate( $data = array() ){

        $request = json_encode( [ 'usuario' => $data['usuario'],'token' => $data['token']] );
        $request = json_decode($request);
        $this->_api = new ValidateTokenController();
        return json_decode( $this->_api::token( $request ) );
    }
    /**
     *Metodo para la validacion de los permisos por cada usuario
     *@access protected
     *@param array data [description]
     *@return integer [regresa el numero de permiso solicitdo]
     */
    protected function permisson_validate(){

        $http_usuario = isset( $_SERVER['HTTP_USUARIO'] )? $_SERVER['HTTP_USUARIO']:"";
        $http_token = isset( $_SERVER['HTTP_TOKEN'] )? $_SERVER['HTTP_TOKEN']:"";
        $request = json_encode( [ 'usuario' => $http_usuario,'token' => $http_token ] );
        $request = json_decode($request);        
        $this->_permission = new ValidatePermissonController();
        return json_decode( $this->_permission::permisson( $request ) );   
    }
    /**
     *Metodo donde muestra el mensaje de success
     *@access protected
     *@param array $data [description]
     *@return json
     */
    protected function _message_success( $code = false, $data = array() ){

        $code = ( $code )? $code : 200 ;
        $datos = [
            "success"   => true,
            "message"   => "Transaccion exitosa.",
            "code"		=> "CPA-".$code."-".$this->setCabecera($code),
            "result"    => $data
        ];
        return response()->json($datos);
    }
    /**
     *Metodo para establecer si se realizo con exito la peticion
     *@access private 
     *@param $codigo [description]
     *@return string [description]
     */
      private function get_status_message( $codigo=false ) {

		     $estado = array(
		       200 => 'OK',
		       201 => 'Created',
		       202 => 'Accepted',
		       204 => 'No Content',
		       301 => 'Moved Permanently',
		       302 => 'Found',
		       303 => 'See Other',
		       304 => 'Not Modified',
		       400 => 'Bad Request',
		       401 => 'Unauthorized',
		       403 => 'Forbidden',
		       404 => 'Not Found',
		       405 => 'Method Not Allowed',
		       500 => 'Internal Server Error'
		   );

		    $respuesta = ($estado[$codigo]) ? $estado[$codigo] : $estado[500];
		    return $respuesta;
   	}
   	/**
	 *Se crea un metodo para mostrar los errores dependinedo la accion a realizar
	 *@access protected
	 *@param int $id []
	 *@return string $errores
	 */
	protected function show_error($id = false, $datos = array()) {

		$errors = [
			#0
			[
				'success' => false,
				'message' => "Acceso Denegado",
				'error'	  => [
					'description' => "No tiene permisos para realizar esta accion",
					'result' 	  => $datos,
					'code' 	=> "CPA-401-".$this->setCabecera(401)
				 ]

			],
			#1
			[
				'success' => false,
				'message' => "Error en la transaccion",
				'error'	  => [
					'description' => "Token expiro y/o cambio, favor de verificar",
					'result' 	  => $datos,
					'code' 	=> "CPA-400-".$this->setCabecera(400)
				 ]

			],
			#2
			[
				'success' => false,
				'message' => "Peticion Incorrecta",
				'error'	  => [
					'description' => "El Servicio de Internet es Incorrecto",
					'result' 	  => $datos,
					'code' 	=> "CPA-500-".$this->setCabecera(500)
				 ]

			],
			#3
			[
				'success' => false,
				'message' => "Identificador diferente y/o vacio",
				'error'	  => [
					'description' => "Verificar los campos solicitados.",
					'result' 	  => $datos,
					'code' 	=> "CPA-204-".$this->setCabecera(204)
				 ]

			],
			#4
			[
				'success' => false,
				'message' => "Sin Registros",
				'error'	  => [
					'description' => "No se encontro ningun registro",
					'result' 	  => $datos,
					'code' 	=> "CPA-204-".$this->setCabecera(204)
				 ]
			],
			#5
			[
				'success' => false,
				'message' => "Sin Registros",
				'error'	  => [
					'description' => "Ingrese datos para poder realizar la accion",
					'result' 	  => $datos,
					'code' 	=> "CPA-204-".$this->setCabecera(204)
				 ]
			]

		];

   			#return json_encode( $errors[$id] );
            return response()->json($errors[$id]);
	}
    /**
    *Se crea un metodo en el cual se establece el formato en el que se enviara la informacion del REST
    *@access protected
    *@param $codigo int [description]
    *@return void
    */
    protected function setCabecera( $codigo ) {

        header("HTTP/1.1 " . $codigo . " " . $this->get_status_message($codigo));
        header("Content-Type:" . $this->tipo . ';charset=utf-8');
        return $this->get_status_message($codigo);
    }
    /**
     *Metodo donde parsea la cadena
     *@access public
     *@return array $datos [description]
     */
    public function parser_string(){

        $datos = [];
        if ($_SERVER['QUERY_STRING']) {
            $params = explode("&", $_SERVER['QUERY_STRING']);
            $params = implode("=", $params);
            $params = explode("=", $params);
            $i = 1;
            foreach ($params as $key => $value) {
                if ($key%2 == 0 ) {
                   $datos[$value] = $params[$i];
                }
                $i++;
            }
        }
        return $datos;
    }
    /**
     *Metodo para verificar si estan correctamete los valores ingresados
     *@access public 
     *@param $data array  [description]
     *@param $class object [description]
     *@return array
     */
    public function parse_register($data = array(), $class, $claves_date = []){

        $datos = [];
        foreach ($data as $key => $value) {
            #verifica que no vayan nulos los campos y si no estan nulos los regresa en un arreglo
            if ($data[$key] == null) {
                return ['success' => false,'result' => $data ];
            }
            if ($value != false) {
                $datos[$key] = $value;
            }
        }  
        #validaciones de datos diferentes.
        if ( array_diff( array_keys($datos), $class->fillable) ) {
            return ['success' => false,'result' => array_values(array_diff( array_keys($datos), $class->fillable))  ];
        }
        #se valida la fecha
        if ($claves_date) {

            for ($i=0; $i < count($claves_date); $i++) { 
                $fecha = self::schema_fecha( $data[$claves_date[$i]] );
                if ( !$fecha['success'] ) {
                    return ['success' => false,'result' => $claves_date[$i] ];        
                 } 
            }

        }
        return $datos;

    }
    /**
     *Metodo para verificar si estan correctamete los valores ingresados
     *@access public 
     *@param $fecha string  [description]
     *@return array
     */
    public function schema_fecha( $fecha= false ){

        if ( $fecha ) {
                $fechas = explode("-", $fecha );
                if ( count($fechas) != 3 ) {
                    return ['success' => false,'message' => "Fecha incorrecta"];
                }
                if ( checkdate( $fechas[1],$fechas[2],$fechas[0]) == false ) {
                    return ['success' => false,'message' => "Fecha incorrecta"];
                }
                return ['success' => true,'message' => "Fecha correcta"];
            
            }
    
    }
   


}