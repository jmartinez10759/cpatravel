<?php

namespace App\Http\Controllers\Web\estado_cuenta;

use App\StatusAccount;
use Illuminate\Http\Request;
use App\Model\Apirest\TblSolicitud;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\Web\MasterWebController;
use App\ModelWeb\estado_cuenta\EstadoCuentaWebModel;

class EstadoCuentaWebController extends MasterWebController
{
    
    public function __construct(){

        parent::__construct();
        $this->session_expire();
    }
    /**
     *Metodo donde se carga la vista de los estados de cuenta.
     *@access public
     *@return html
     */
    public function index(){

    	$url               = "http://".$this->_domain."/api/travel/proyecto?status=1";
        $url_subproyectos  = "http://".$this->_domain."/api/travel/subproyectos?status=1";
        $url_viajes        = "http://".$this->_domain."/api/travel/viajes?status=1";
        $url_etiquetas     = "http://".$this->_domain."/api/travel/etiquetas?etiqueta_tipo=predeterminadas";

        $headers = [ 
            'Content-Type'  => 'application/json'
            ,'usuario'      => $_SERVER['HTTP_USUARIO']
            ,'token'        => $_SERVER['HTTP_TOKEN']
          ];
        $datos=[];
        $method = 'get';
        $proyecto           = self::endpoint($url,$headers,$datos,$method);
        $subproyectos       = self::endpoint($url_subproyectos,$headers,$datos,$method);
        $viajes             = self::endpoint($url_viajes,$headers,$datos,$method);
        $etiquetas          = self::endpoint($url_etiquetas,$headers,$datos,$method);


        $select_proyecto = dropdown([
            'data'       => isset( $proyecto->result )? $proyecto->result :[]
            ,'value'     => 'id_proyecto'
            ,'text'      => 'nombre'
            ,'id'        => 'id_proyecto'
            ,'class'     => 'form-control'
            ,'leyenda'   => "-- SELECCIONE --"
            ,'event'     => 'show_subproyecto(this)'
        ]);

        $select_subproyecto = dropdown([
                'data'       => isset( $subproyectos->result )? $subproyectos->result :[]
                ,'value'     => 'id_subproyecto'
                ,'text'      => 'nombre'
                ,'id'        => 'id_subproyecto'
                ,'class'     => 'form-control'
                ,'leyenda'   => "-- SELECCIONE --"
                ,'attr'      => 'disabled'
                ,'event'     => 'show_viajes(this)'
            ]);
        $select_viaje = dropdown([
            'data'       => isset( $viajes->result )? $viajes->result :[]
            ,'value'     => 'id_viaje'
            ,'text'      => 'nombre'
            ,'id'        => 'id_viaje'
            ,'class'     => 'form-control'
            ,'leyenda'   => "-- SELECCIONE --"
            ,'attr'      => 'disabled'
            ,'event'     => 'data_viajes(this)'
        ]);

        $select_etiquetas = dropdown([
            'data'       => isset( $etiquetas->result )? $etiquetas->result :[]
            ,'value'     => 'id_etiqueta'
            ,'text'      => 'etiqueta_nombre'
            ,'id'        => 'id_etiqueta'
            ,'class'     => 'form-control'
            ,'leyenda'   => "-- SELECCIONE --"
            ,'event'     => 'etiquetas(this)'
        ]);

        $select_estatus = dropdown([
            'data'       => StatusAccount::where( ['active'=> 1] )->get()
            ,'value'     => 'id'
            ,'text'      => 'name'
            ,'id'        => 'id_estatus'
            ,'class'     => 'form-control'
            ,'leyenda'   => "-- SELECCIONE --"
        ]);

        $where = [
            'id_empresa'  => Session::get('business_id')
            ,'id_usuario' => $_SERVER['HTTP_USUARIO']
         ];
         
         #debuger(Session::all());
         #debuger($this->_tipo_user);
        $solicitudes = json_to_object( TblSolicitud::solicitudes_model( $where ) );
        #debuger($solicitudes);
         $titulos = [

                    'Proyecto'
                    ,'Sub Proyecto'
                    ,'Viaje'
                    ,'Fecha Inicio'
                    ,'Fecha Fin'
                    ,'Destino'
                    ,'Estatus'
                    ,'Total'
                    ,''
                    ,''
                    ,''
                ];
        $table = array(
                'titulos'       => $titulos
                ,'registros'    => $solicitudes->result
                ,'class'        => "table table-hover table-striped table-response"
                ,'class_thead'   => ""
        );

        $data = [
            'titulo_principal'      => "Estados de Cuenta"
            ,'avatar'               => ( !is_null(Session::get('img') ) )? Session::get('img') : asset('images/avatar.jpeg')
            ,'usuario'              => Session::get('name')
            ,'select_proyecto'      => $select_proyecto
            ,'select_subproyecto'   => $select_subproyecto
            ,'select_viaje'         => $select_viaje
            ,'select_etiquetas'     => $select_etiquetas
            ,'select_estatus'       => $select_estatus
            #,'tabla_estado_cuenta' => data_table_general($table)
            ,'tabla_estado_cuenta' => ( isset($solicitudes->result) )? $solicitudes->result :false
        ];
        #debuger($data);
        return view('account.estados_cuenta',$data);

    }
    /**
     *Metodo de controller donde se realiza la parte del filtro
     *@access public 
     *@param Request $request [Description]
     *@return html
     */
    public function filtros ( Request $request ){
        
        $where = [
            'id_empresa'        => Session::get('business_id')
            ,'id_usuario'       => $_SERVER['HTTP_USUARIO']
        ];
        $cond = [];
        foreach ($request->all() as $key => $value) {
            if ( $value ) {
                $cond[$key] = $value;
            }
        }
        $condicion = array_merge($where,$cond);
        $response = json_to_object( TblSolicitud::solicitudes_model( $condicion ) );

        if ( $response->success == true ) {
            return message($response->success,$response->result,'Transaccion Realizada');
        }else{
            return message($response->success,[],'¡Ocurrio un Error!');
        }

    }





}
