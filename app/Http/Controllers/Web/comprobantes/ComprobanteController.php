<?php

namespace App\Http\Controllers\Web\comprobantes;

use App\Model\MasterModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Web\MasterWebController;

class ComprobanteController extends MasterWebController
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
    public function register(){

    	$data = [
    		'titulo_principal' => "Ingresar Datos Factura"
    		,'usuario'         => Session::get('name')
            ,'avatar'          => ( !is_null(Session::get('img') ) )? Session::get('img') : asset('images/avatar.jpeg')
    	];
    	return view('comprobantes/comprobantes',$data);

    }
    /**
     *Metodo controller donde se hace una busqueda del CFDI
     *@access public 
     *@return void
     */
    public function busqueda(){
    	
        $url_proyectos     = $this->_http."://".$this->_domain."/api/travel/proyecto?status=1";
        $url_subproyectos  = $this->_http."://".$this->_domain."/api/travel/subproyectos?status=1";
        $url_viajes        = $this->_http."://".$this->_domain."/api/travel/viajes?status=1";

        $headers = [ 
            'Content-Type'  => 'application/json'
            ,'usuario'      => $_SERVER['HTTP_USUARIO']
            ,'token'        => $_SERVER['HTTP_TOKEN']
          ];
        $datos=[];
        $method = 'get';
        $proyecto           = self::endpoint($url_proyectos,$headers,[],$method);
        $subproyectos       = self::endpoint($url_subproyectos,$headers,[],$method);
        $viajes             = self::endpoint($url_viajes,$headers,[],$method);

        $select_proyecto = dropdown([
                'data'       => isset( $proyecto->result )? $proyecto->result :[]
                ,'value'     => 'id_proyecto'
                ,'text'      => 'nombre'
                ,'id'        => 'proyecto'
                ,'class'     => 'form-control'
                ,'leyenda'   => "-- SELECCIONE --"
                ,'event'     => 'show_subproyecto(this)'
            ]);

        $select_subproyecto = dropdown([
                'data'       => isset( $subproyectos->result )? $subproyectos->result :[]
                ,'value'     => 'id_subproyecto'
                ,'text'      => 'nombre'
                ,'id'        => 'subproyectos'
                ,'class'     => 'form-control'
                ,'leyenda'   => "-- SELECCIONE --"
                ,'attr'      => 'disabled'
                ,'event'     => 'show_viajes(this)'
            ]);
        $select_viaje = dropdown([
            'data'       => isset( $viajes->result )? $viajes->result :[]
            ,'value'     => 'id_viaje'
            ,'text'      => 'nombre'
            ,'id'        => 'viajes'
            ,'class'     => 'form-control'
            ,'leyenda'   => "-- SELECCIONE --"
            ,'attr'      => 'disabled'
        ]);




		$data = [
    		'titulo_principal' => "Buscar Factura CFDI"
    		,'usuario'         => Session::get('name')
            ,'avatar'          => ( !is_null(Session::get('img') ) )? Session::get('img') : asset('images/avatar.jpeg')
            ,'proyectos'            => $select_proyecto
            ,'subproyectos'         => $select_subproyecto
            ,'viajes'               => $select_viaje
    	];
        #debuger(Session::all());
    	return view('comprobantes/busquedas',$data);    	
    }
    /**
     *Metodo controller para agregar un comprobante de cfdi
     *@access public
     *@param Request $request [description]
     *@return json
     */
    public function create ( Request $request ){
        $fields = [];
        foreach ($request->all() as $key => $value) {
            
            if ($value && $key != 'receptor') {
                $fields[$key] = $value;    
            }
            if ( $key == "id_proyecto" || $key == "id_subproyecto" || $key == "id_viaje" ) {
                if (!$value) {
                    return message(false,[],"Verificar la seccion de Proyectos,Subproyectos y Viajes");
                }
            }
        }
        #$fields['empresa'] = Session::get('business_id');
        $fields['empresa'] = 11990;
        $url_servicio   = "http://internal-validacion-1942019382.us-east-1.elb.amazonaws.com:8084/buscarCfdi";
        $headers        = ['Content-Type'=> 'application/json'];
        $data           = $fields;
        $method         = "post";
        $response       = self::endpoint($url_servicio,$headers,$data,$method);
        #debuger($response);
        if ( $response->success == true ) {
            return message(true,$response->doc,"Transaccion Existosa");
        }else{
            return message(false,[],"Ningun registro encontrado");
        }

    }
    /**
     *Metodo que se encarga de crear la vista de los comprobantes que no pertenecen a CFDI
     *@access public
     *@return void
     */
    public function nocfdi(){

        $url = $this->_http."://".$this->_domain."/api/travel/etiquetas?etiqueta_tipo=predeterminadas";
        $url_proyectos     = $this->_http."://".$this->_domain."/api/travel/proyecto?status=1";
        $url_subproyectos  = $this->_http."://".$this->_domain."/api/travel/subproyectos?status=1";
        $url_viajes        = $this->_http."://".$this->_domain."/api/travel/viajes?status=1";

        $headers = [ 
            'Content-Type'  => 'application/json'
            ,'usuario'      => $_SERVER['HTTP_USUARIO']
            ,'token'        => $_SERVER['HTTP_TOKEN']
          ];
        $datos=[];
        $method = 'get';
        $etiquetas          = self::endpoint($url,$headers,$datos,$method);
        $proyecto           = self::endpoint($url_proyectos,$headers,[],$method);
        $subproyectos       = self::endpoint($url_subproyectos,$headers,[],$method);
        $viajes             = self::endpoint($url_viajes,$headers,[],$method);

        $select_etiquetas = dropdown([
            'data'       => isset( $etiquetas->result )? $etiquetas->result :[]
            ,'value'     => 'id_etiqueta'
            ,'text'      => 'etiqueta_nombre'
            ,'id'        => 'id_etiqueta'
            ,'class'     => 'form-control'
            ,'leyenda'   => "-- SELECCIONE --"
            ,'event'     => ''
        ]);

        $select_proyecto = dropdown([
                'data'       => isset( $proyecto->result )? $proyecto->result :[]
                ,'value'     => 'id_proyecto'
                ,'text'      => 'nombre'
                ,'id'        => 'proyecto'
                ,'class'     => 'form-control'
                ,'leyenda'   => "-- SELECCIONE --"
                ,'event'     => 'show_subproyecto(this)'
            ]);

        $select_subproyecto = dropdown([
                'data'       => isset( $subproyectos->result )? $subproyectos->result :[]
                ,'value'     => 'id_subproyecto'
                ,'text'      => 'nombre'
                ,'id'        => 'subproyectos'
                ,'class'     => 'form-control'
                ,'leyenda'   => "-- SELECCIONE --"
                ,'attr'      => 'disabled'
                ,'event'     => 'show_viajes(this)'
            ]);
        $select_viaje = dropdown([
            'data'       => isset( $viajes->result )? $viajes->result :[]
            ,'value'     => 'id_viaje'
            ,'text'      => 'nombre'
            ,'id'        => 'viajes'
            ,'class'     => 'form-control'
            ,'leyenda'   => "-- SELECCIONE --"
            ,'attr'      => 'disabled'
        ]);


        $data = [
            'titulo_principal'      => "No CFDI"
            ,'usuario'              => Session::get('name')
            ,'avatar'               => ( !is_null(Session::get('img') ) )? Session::get('img') : asset('images/avatar.jpeg')
            ,'select_etiqueta'      => $select_etiquetas
            ,'proyectos'            => $select_proyecto
            ,'subproyectos'         => $select_subproyecto
            ,'viajes'               => $select_viaje
        ];
        return view('comprobantes/nocfdi',$data);

    }



}
