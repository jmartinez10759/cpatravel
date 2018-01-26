<?php

namespace App\Http\Controllers;

use Log;
use Session;
use Validator;
use App\TblProyecto;
use App\TblSubProyecto;
use App\TblViaje;
use Illuminate\Http\Request;
use App\Http\Controllers\ViajeWebController;
use App\Http\Controllers\SubProyectoWebController;
use App\Http\Controllers\Web\MasterWebController;

class ProyectoWebController extends MasterWebController
{
    //private $_permits;
    #private $_domain = "34.225.245.91"; #34.225.245.91
    
    public function __construct(){
        parent::__construct();
        $this->session_expire();
        //$this->_permits=  self::verify_permison();
    }
    /**
  	 *Metodo que obtiene los datos de los proyectos,subproyectos y viajes
  	 *@access public 
  	 *@return array
  	 */
    public function index(){

        $url = "http://".$this->_domain."/api/travel/proyecto?status=1";
        #se utiliza este metodo para consumir el endpoint creado.
        $headers = [ 
            'Content-Type'  => 'application/json'
            ,'usuario'      => $_SERVER['HTTP_USUARIO']
            ,'token'        => $_SERVER['HTTP_TOKEN']
        ];
        $data = [];
        $method = "get";
        $response = self::endpoint($url,$headers,$data,$method);
        #debuger($response);
        $array= [];
        $i=0;

        $listado = [];

        if ($response->success == true) {

            foreach ($response->result as $proyecto) {

              $where = ['id_proyecto' => $proyecto->id_proyecto ];
              $listado[] = [
                'id_proyecto'   => $proyecto->id_proyecto
                ,'nombre'       => $proyecto->nombre
                ,'subproyecto'  => json_to_object( SubProyectoWebController::consulta_subproyectos( $where ) )->result
              ];
            }

        }
        #debuger($listado);
  		 $datos = [

  		      'data'                    => $listado
  		      ,'titulo_principal'       => "PROYECTOS, SUBPROYECTOS Y VIAJE. "
            ,'usuario'                => Session::get('name')
  		      ,'id_empresa'             => Session::get('business_id')
  		      ,'avatar'                 => ( !is_null(Session::get('img') ) )? Session::get('img') : asset('images/avatar.jpeg')
            ,'return'                 => route('business_process')
  		  ];
    		     return view('process_bussines/project-main',$datos);
    
    }
    /**
     *Metodo para obtener un proyecto seleccioando
     *@access public
     *@param
     *@return void
     */
    public function showById( Request $request ){

        $url = "http://".$this->_domain."/api/travel/proyecto?id_proyecto=".$request->id_proyecto;
       #se utiliza este metodo para consumir el endpoint creado.
          $headers = [ 
            'Content-Type'  => 'application/json'
            ,'usuario'      => $_SERVER['HTTP_USUARIO']
            ,'token'        => $_SERVER['HTTP_TOKEN']
          ];
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
      
      $url      = "http://".$this->_domain."/api/travel/proyecto";
      $url_get  = "http://".$this->_domain."/api/travel/proyecto?id_empresa=".Session::get('business_id')."&nombre=".$request->nombre."&proyecto=".$request->proyecto;
      $headers = [ 
            'Content-Type'  => 'application/json'
            ,'usuario'      => $_SERVER['HTTP_USUARIO']
            ,'token'        => $_SERVER['HTTP_TOKEN']
          ];
          $data = [ 'data' => [
                         'id_empresa'   => Session::get('business_id')
                        ,'nombre'       => $request->nombre
                        ,'proyecto'     => $request->proyecto
                        ,'status'       => $request->status
                  ]
                ];
          $method = 'post';
        # se realiza una validacion de los datos ingresados.
          $response = self::endpoint($url_get,$headers,[],"get");
          if ($response->success == true) {
            return message(false,[],"Este Registro ya se encuentra almacenado.");
          }
       #se utiliza este metodo para consumir el endpoint creado.
          $respuesta = self::endpoint($url,$headers,$data,$method);
          if ($respuesta->success == true) {
            return message( $respuesta->success, $respuesta->result, $respuesta->message );
          }else{
            return message( $respuesta->success, [], $respuesta->message );
          }

    }
    /**
     *Metodo controller donde se utiliza para actualizar los datos
     *@access public
     *@param Request $resquest [description]
     *@return
     */
    public function actualizar( Request $request ){

        $url = "http://".$this->_domain."/api/travel/proyecto";
        $headers = [ 
            'Content-Type'  => 'application/json'
            ,'usuario'      => $_SERVER['HTTP_USUARIO']
            ,'token'        => $_SERVER['HTTP_TOKEN']
        ];
        $data = [ 'data' => [
                         'id_proyecto'  => $request->id_proyecto
                        ,'nombre'       => $request->nombre
                        ,'proyecto'     => $request->proyecto
                        ,'status'       => $request->status
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
