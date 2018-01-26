<?php

namespace App\Http\Controllers;

use Log;
use Session;
use Validator;
use App\TblViaje;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\MasterWebController;

class ViajeWebController extends MasterWebController
{
    
    public function __construct(){
        parent::__construct();
        $this->session_expire();
    }
    /**
     *Metodo para la creacion de los viajes 
     *@access public 
     *@param 
     *@return json
     */
	public function create( Request $request){

    	  $url        = "http://".$this->_domain."/api/travel/viajes";
        $url_get    = "http://".$this->_domain."/api/travel/viajes?nombre=".$request->nombre."&viaje=".$request->viaje;
        $headers = [ 
            'Content-Type'    => 'application/json'
            ,'usuario'        => $_SERVER['HTTP_USUARIO']
            ,'token'          => $_SERVER['HTTP_TOKEN']
        ];
        $data = [
                'data' => [
                        'id_proyecto'       => $request->id_proyecto
                        ,'id_subproyecto'   => $request->id_subproyecto
                        ,'nombre'           => $request->nombre
                        ,'viaje'            => $request->viaje
                        ,'status'           => $request->status
                    ]
            ];
          $response = self::endpoint($url_get,$headers,[],"get");
          if ($response->success == true) {
                return message(false,[],"Este Registro ya se encuentra almacenado.");
            #return json_encode([ 'success' => false,"message" => "Este Registro ya se encuentra almacenado." ]);
          }
        $method = 'post';
        $result = self::endpoint($url,$headers,$data,$method);
        if ($result->success == true) {
           return message( $result->success, $result->result, $result->message );
        }else{
	       return message( $response->success,[], $response->message );
        }

	}
	/**
	 *Metodo para mostrar la consulta de un solo registro
	 *@access public
	 *@param 
	 *@return void
	 */
	public function show( Request $request ){

		$url = "http://".$this->_domain."/api/travel/viajes?id_viaje=".$request->id_viaje."&id_proyecto=".$request->id_proyecto."&id_subproyecto=".$request->id_subproyecto;
		$headers = [ 
        		'Content-Type'    => 'application/json'
        		,'usuario'        => $_SERVER['HTTP_USUARIO']
        		,'token'          => $_SERVER['HTTP_TOKEN']
        	];
        $method = 'get';
        $data = [];
		$response = self::endpoint($url,$headers,$data,$method);

        if ($response->success == true) {
            
            return message( $response->success, $response->result, $response->message );
        }else{
            return message( $response->success,[], $response->message );
        }

	}
    /**
     *Metodo para mostrar la consulta de un solo registro
     *@access public
     *@param 
     *@return void
     */
    public function show_by_id( Request $request ){

        $url = "http://".$this->_domain."/api/travel/viajes?id_proyecto=".$request->id_proyecto."&id_subproyecto=".$request->id_subproyecto;
        $headers = [ 
                'Content-Type'  => 'application/json'
                ,'usuario'      => $_SERVER['HTTP_USUARIO']
                ,'token'        => $_SERVER['HTTP_TOKEN']
            ];
            $data = [];
            $method = 'get';
            $response = self::endpoint($url,$headers,$data,$method);

            if ($response->success == true) {
                return message( $response->success, $response->result, $response->message );
            }else{
                return message( $response->success,[], $response->message );
            }
    }

    /**
     *Metodo controller donde se muestra los resultados de la consulta
     *@access public 
     *@param $where array [description]
     *@return json
     */
    public static function consulta_viajes( $where = array() ){

        $response = json_to_object( TblViaje::consulta_model( $where ) );
        if ($response->success == true) {
            return message($response->success,$response->result,$response->message);
        }else{
            return message($response->success,[],$response->message);
        }

    }
    /**
     *Metodo controller donde se utiliza para actualizar los datos
     *@access public
     *@param Request $resquest [description]
     *@return
     */
    public function actualizar( Request $request ){

        $url        = "http://".$this->_domain."/api/travel/viajes";
        $headers = [ 
            'Content-Type'    => 'application/json'
            ,'usuario'        => $_SERVER['HTTP_USUARIO']
            ,'token'          => $_SERVER['HTTP_TOKEN']
        ];
        $data = [
                'data' => [
                        'id_viaje'          => $request->id_viaje
                        ,'nombre'           => $request->nombre
                        ,'viaje'            => $request->viaje
                        ,'status'           => $request->status
                    ]
            ];
        $method = 'put';
        $response = self::endpoint($url,$headers,$data,$method);
        if ($response->success == true) {
            return message( $response->success, $response->result, $response->message );
        }else{
            return message( $response->success, [], $response->message );
        }        

    }


}
