<?php

namespace App\Http\Controllers;

use Log;
use Session;
use Validator;
use App\TblSubProyecto;
use Illuminate\Http\Request;
use App\Http\Controllers\ViajeWebController;
use App\Http\Controllers\Web\MasterWebController;

class SubProyectoWebController extends MasterWebController
{
    
    public function __construct(){
    	parent::__construct();
        $this->session_expire();
    }
    /**
     *Metodo para obtener un registro con base a un proyecto
     *@access public
     *@param 
     *@return void
     */
    public function index( Request $request ){

    	$url = "http://".$this->_domain."/api/travel/subproyectos?id_proyecto=".$request->id_proyecto."&id_subproyecto=".$request->id_subproyecto;
    	$headers = [ 
        		'Content-Type'    => 'application/json'
        		,'usuario'        => $_SERVER['HTTP_USUARIO']
        		,'token'          => $_SERVER['HTTP_TOKEN']
        	];
        #se utiliza este metodo para consumir el endpoint creado.
        $data = [];
        $method = "get";
        $response = self::endpoint($url,$headers,$data,$method);
        #debuger($response);
        if ($response->success == true) {
           return message( $response->success, $response->result[0],$response->message );
        }else{
    	   return message( $response->success, [],$response->message );
        }

    }
    /**
     *Metodo para obtener un registro con base a un proyecto
     *@access public
     *@param Request $request [description]
     *@return json
     */
    public function create (Request $request){

    	$url = "http://".$this->_domain."/api/travel/subproyectos";

    	$headers = [ 
        		'Content-Type'    => 'application/json'
        		,'usuario'        => $_SERVER['HTTP_USUARIO']
        		,'token'          => $_SERVER['HTTP_TOKEN']
        	];
        	$data = ['data' => [
		                    'id_proyecto'     	=> $request->id_proyecto
		                    ,'nombre'  			=> $request->nombre
		                    ,'sub_proyecto'  	=> $request->sub_proyecto
		                    ,'status'  			=> $request->status
		            	]
		            ];
       
        # se realiza una validacion de los datos ingresados.
          $url_get = "http://".$this->_domain."/api/travel/subproyectos?nombre=".$request->nombre."&sub_proyecto=".$request->sub_proyecto;
          $response = self::endpoint($url_get,$headers,[],"get");
          if ($response->success == true) {
            return json_encode([ 'success' => false,"message" => "Este Registro ya se encuentra almacenado." ]);
          }
          $method = "post";
         #se utiliza este metodo para consumir el endpoint creado.
         $result = self::endpoint($url,$headers,$data,$method);
         if ($result->success == true) {
            return message( $result->success, $result->result,$result->message );
         }else{
            return message( $result->success, [],$result->message );
         }

    }
    /**
     *Metodo para obtener los registros de los subproyectos con el id de proyectos
     *@access public
     *@param Request [description]
     *@return void
     */
    public function show_subproyectos( Request $request ){

        $url = "http://".$this->_domain."/api/travel/subproyectos?id_proyecto=".$request->id_proyecto;
        $headers = [ 
                'Content-Type'  => 'application/json'
                ,'usuario'      => $_SERVER['HTTP_USUARIO']
                ,'token'        => $_SERVER['HTTP_TOKEN']
            ];
       #se utiliza este metodo para consumir el endpoint creado.
        $method = 'get';
        $response = self::endpoint($url,$headers,[],$method);
        if ($response->success == true) {
            return message( $response->success, $response->result,$response->message );
        }else{
            return message( $response->success, [],$response->message );
        }


    }
    /**
     *Metodo controller donde se muestra los resultados de la consulta
     *@access public 
     *@param $where array [description]
     *@return json
     */
    public static function consulta_subproyectos( $where = array() ){

        $response = json_to_object( TblSubProyecto::consulta( $where ) );
        $result = [];
        if ($response->success == true) {

            foreach ($response->result as $response) {

                $where = [
                    'id_subproyecto'    => $response->id_subproyecto
                    ,'id_proyecto'      => $response->id_proyecto
                ];
                $result[] = [
                    'id_subproyecto'    => $response->id_subproyecto
                    ,'id_proyecto'      => $response->id_proyecto
                    ,'nombre'           => $response->nombre
                    ,'sub_proyecto'     => $response->sub_proyecto
                    ,'viajes'           => json_to_object(ViajeWebController::consulta_viajes( $where ))->result
                ];
            }
            return message(true,$result,'Consulta exitosa');
        }else{
            return message(false,[],$response->message);
        }

    }




}
