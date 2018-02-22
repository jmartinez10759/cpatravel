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
    	
		$data = [
    		'titulo_principal' => "Buscar Factura CFDI"
    		,'usuario'         => Session::get('name')
            ,'avatar'          => ( !is_null(Session::get('img') ) )? Session::get('img') : asset('images/avatar.jpeg')
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
        }
        #$fields['empresa'] = Session::get('business_id');
        $fields['empresa'] = 11990;
        $url_servicio   = "http://internal-validacion-1942019382.us-east-1.elb.amazonaws.com:8084/buscarCfdi";
        $headers        = ['Content-Type'=> 'application/json'];
        $data           = $fields;
        $method         = "post";
        $response = self::endpoint($url_servicio,$headers,$data,$method);
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

        $url = "http://".$this->_domain."/api/travel/etiquetas?etiqueta_tipo=predeterminadas";
        $headers = [ 
            'Content-Type'  => 'application/json'
            ,'usuario'      => $_SERVER['HTTP_USUARIO']
            ,'token'        => $_SERVER['HTTP_TOKEN']
          ];
        $datos=[];
        $method = 'get';
        $etiquetas        = self::endpoint($url,$headers,$datos,$method);
        $select_etiquetas = dropdown([
            'data'       => isset( $etiquetas->result )? $etiquetas->result :[]
            ,'value'     => 'id_etiqueta'
            ,'text'      => 'etiqueta_nombre'
            ,'id'        => 'id_etiqueta'
            ,'class'     => 'form-control'
            ,'leyenda'   => "-- SELECCIONE --"
            ,'event'     => ''
        ]);

        $data = [
            'titulo_principal' => "No CFDI"
            ,'usuario'         => Session::get('name')
            ,'avatar'          => ( !is_null(Session::get('img') ) )? Session::get('img') : asset('images/avatar.jpeg')
            ,'select_etiqueta' => $select_etiquetas
        ];
        #debuger($data);
        return view('comprobantes/nocfdi',$data);

    }



}
