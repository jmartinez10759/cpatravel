<?php

namespace App\Http\Controllers\Web;

#use App\Http\Controllers;
#use App\Request as Solicitude;
use Session;
use App\Label;
use App\Country;
use App\StatusAccount;
use App\Model\MasterModel;
use App\ModelWeb\TblHorario;
use Illuminate\Http\Request;
use App\Model\Apirest\TblEtiqueta;
use App\Model\Apirest\TblSolicitud;
use App\ModelWeb\CatSolicitudMonto;
use App\ModelWeb\CatViaticoDetalle;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\Web\MasterWebController;

class SolicitudViajeController extends MasterWebController
{

    public function __construct(){

        parent::__construct();
        $this->session_expire();
    }
    /**
     *Metodo para la carga de la vista y cargar sus elementos correspondiente
     *@access public 
     *@return
     */
    public function index( Request $request ){

         $url               = "http://".$this->_domain."/api/travel/proyecto?status=1";
         $url_subproyectos  = "http://".$this->_domain."/api/travel/subproyectos?status=1";
         $url_viajes        = "http://".$this->_domain."/api/travel/viajes?status=1";
         $url_etiquetas     = "http://".$this->_domain."/api/travel/etiquetas?etiqueta_tipo=predeterminadas";
         $headers = [ 
            'Content-Type'  => 'application/json'
            ,'usuario'      => $_SERVER['HTTP_USUARIO']
            ,'token'        => $_SERVER['HTTP_TOKEN']
          ];
         $method = 'get';
            $proyecto           = self::endpoint($url,$headers,[],$method);
            $subproyectos       = self::endpoint($url_subproyectos,$headers,[],$method);
            $viajes             = self::endpoint($url_viajes,$headers,[],$method);
            $etiquetas          = self::endpoint($url_etiquetas,$headers,[],$method);
            #debuger($etiquetas);
            $databaseUsers = [
                [
                    "id"        => 4152589,
                    "username"  => "ricardo@cpavs.mx",
                    "name"      => "Ricardo apellido_1 apellido_2"
                ],
                [
                    "id"        => 7377382,
                    "username"  => "omar@cpavs.mx",
                    "name"      => "Omar apellido_1 apellido_2"
                ],
                [
                    "id"        => 748137,
                    "username"  => "juliocastrop@cpavs.mx",
                    "name"      => "julio apellido_1 apellido_2"
                ]
            
            ];

            $horario = dropdown([
                'data'      => TblHorario::get()
                ,'value'     => 'rango'
                ,'text'      => 'rango'
                ,'id'        => 'hora_salida'
                ,'class'     => 'form-control-sm'
                #'event'     => 'loadEmpresas(this.value)'
            ]);

            $hora_final = dropdown([
                'data'      => TblHorario::get()
                ,'value'     => 'rango'
                ,'text'      => 'rango'
                ,'id'        => 'hora_final'
                ,'class'     => 'form-control-sm'
            ]);

            $country_inicio = dropdown([
                'data'      => Country::orderBy('name','ASC')->get()
                ,'value'     => 'name'
                ,'text'      => 'name'
                ,'id'        => 'id_destino_inicial'
                ,'class'     => 'form-control-sm'
                ,'leyenda'   => "-- SELECCIONE --"
            ]);

            $country_final = dropdown([
                'data'      => Country::orderBy('name','ASC')->get()
                ,'value'     => 'name'
                ,'text'      => 'name'
                ,'id'        => 'id_destino_final'
                ,'class'     => 'form-control-sm'
                ,'leyenda'   => "-- SELECCIONE --"
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

            $bpm = new ServiciosController();

            $data = [
                "titulo_principal"  	=> "SOLICITUD DE GASTOS DE VIAJE"
                ,'leyenda'              => "TIPO DE VIATICO: "
                ,'usuario'              => Session::get('name')
                ,'avatar'               => ( !is_null(Session::get('img') ) )? Session::get('img') : asset('images/avatar.jpeg')
    		    ,'id_empresa'           => Session::get('business_id')
                ,'country_inicio'       => $country_inicio
                ,'country_final'        => $country_final
                #,'modelado_auth'    	=> $bpm->bpm_auth()
                ,'horario'              => $horario
                ,'hora_final'		    => $hora_final
                ,'usuarios'             => $databaseUsers
                ,'etiquetas'            => isset( $etiquetas->result )?$etiquetas->result:[]
                ,'proyectos'            => $select_proyecto
                ,'subproyectos'         => $select_subproyecto
                ,'viajes'			    => $select_viaje
                ,'proyecto_url' 		=> route('show_subproyectos')
                ,'subproyecto_url' 		=> route('show_by_id')
                ,'viaticos'             => route('viaticos')
                ,'cargar_solicitud'     => route('solicitud_carga_solicitud')
                ,'solicitud_show'       => route('solicitud_show_solicitud')
                ,'return'               => route('solicitud_viaje_pendiente')

            ];
            #debuger($data);
            return view( 'solicitud.solicitud_travel',$data );

    }
    /**
     *Metodo controller donde se carga toda la informacion para realizar el proceso.
     *@access public 
     *@param Request $request [description]
     *@return void
     */
    
    /*public static function carga_view_main(){}*/

    /**
     *Metodo para la creacion de solicitud, viaticos y montos
     *@access public
     *@param Request $request [Description]
     *@return json
     */    
    public function save_viaticos_solicitud( Request $request ){

        $id_solicitud = ( !empty( $request->id_solicitud ) )? $request->id_solicitud : false;
        #si la solicitud es null hacer una inserccion a la tabla solicitudes y lo cachamos verificando que es el ultimo registro
        if ( !$id_solicitud ) {
            
            $solicitud = json_to_object(TblSolicitud::save_solicitud_model( $request ));
            
            if ( $solicitud->success == true ) {
                #se manda a llamar el metodo a insertar
                $data = [
                    'id_solicitud'                  => $solicitud->result->id_solicitud
                    ,'id_viatico'                   => $request->id_viatico   
                    ,'id_usuario'                   => $_SERVER['HTTP_USUARIO']
                    ,'id_empresa'                   => Session::get('business_id')
                    ,'viatico_cantidad'             => $request->viatico_cantidad
                    ,'viatico_unidad'               => $request->viatico_unidad
                    ,'viatico_costo_unitario'       => $request->viatico_costo_unitario
                ];
                $viaticos = json_to_object( CatViaticoDetalle::save_viaticos( $data ) );
                #debuger($viaticos->result->id_detalle);
                if ($viaticos->success == true) {
                    #se manda a llamar los montos para insertar
                    $datos = [
                        'id_solicitud'                  => $solicitud->result->id_solicitud
                        ,'id_detalle'                   => $viaticos->result->id_detalle
                        ,'id_viatico'                   => $request->id_viatico
                        ,'id_empresa'                   => Session::get('business_id')
                        ,'id_usuario'                   => $_SERVER['HTTP_USUARIO']
                        ,'monto_tipo_solicitud'         => $request->monto_tipo_solicitud
                        ,'monto_tipo_pago'              => $request->monto_tipo_pago
                        ,'monto_importe'                => $request->monto_importe
                        ,'monto_importe_autorizado'     => $request->monto_importe_autorizado
                    ];
                    $montos = json_to_object( CatSolicitudMonto::save_montos( $datos ) );
                    #debuger($montos);
                    if ( $montos->success == true ) {

                        $response = [
                            'solicitud'     => $solicitud->result
                            ,'viaticos'     => $viaticos->result
                            ,'montos'       => $montos->result
                        ];
                        return message($montos->success,$response,'Transaccion Exitosa');

                    }else{return json_encode(['success' => false ,'message' => "Ocurrio un Error"]); }

                }else{return json_encode(['success' => false ,'message' => "Ocurrio un Error"]); }

            }else{ return json_encode(['success' => false, 'message' => "Ocurrio un error"]); }
            
        }else{

            $data = [ 
                'id_solicitud' => $id_solicitud 
                ,'id_empresa'  =>  Session::get('business_id')
                ,'id_usuario'  => $_SERVER['HTTP_USUARIO']
            ];
            $solicitud = json_to_object( TblSolicitud::solicitudes_pendientes( $data ) );
            #debuger($solicitud);
            #unicamente se insertan los viaticos y montos
            $data = [
                    'id_solicitud'                  => $request->id_solicitud
                    ,'id_viatico'                   => $request->id_viatico   
                    ,'id_usuario'                   => $_SERVER['HTTP_USUARIO']
                    ,'id_empresa'                   => Session::get('business_id')
                    ,'viatico_cantidad'             => $request->viatico_cantidad
                    ,'viatico_unidad'               => $request->viatico_unidad
                    ,'viatico_costo_unitario'       => $request->viatico_costo_unitario
                ];
            $viaticos = json_to_object( CatViaticoDetalle::save_viaticos( $data ) );
            #debuger($viaticos);
            if ( $viaticos->success == true ) {
                #se manda a llamar los montos para insertar
                $datos = [
                        'id_solicitud'                  => $request->id_solicitud
                        ,'id_detalle'                   => $viaticos->result->id_detalle
                        ,'id_viatico'                   => $request->id_viatico
                        ,'id_empresa'                   => Session::get('business_id')
                        ,'id_usuario'                   => $_SERVER['HTTP_USUARIO']
                        ,'monto_tipo_solicitud'         => $request->monto_tipo_solicitud
                        ,'monto_tipo_pago'              => $request->monto_tipo_pago
                        ,'monto_importe'                => $request->monto_importe
                        ,'monto_importe_autorizado'     => $request->monto_importe_autorizado
                    ];
                $montos = json_to_object( CatSolicitudMonto::save_montos( $datos ) );

                if ( $montos->success == true ) {
                        
                        $response = [
                            'solicitud'     => $solicitud->result
                            ,'viaticos'     => $viaticos->result
                            ,'montos'       => $montos->result
                        ];
                        return message($montos->success,$response,'Transaccion Exitosa');
                        
                    }else{
                       return json_encode(['success' => false, 'message' => "Ocurrio un Error"]); 
                    }
                
            }else{
                return json_encode(['success' => false, 'message' => "Ocurrio un Error"]); 
            }           

        }


    }
    /**
     *Metodo para la creacion de unicamanente de la solicitud
     *@access public
     *@param Request $request [Description]
     *@return json
     */
    public function save_solicitud( Request $request ){
        #debuger($request->all());
        #se cargan los datos para mandarlos a insertar a la tabla de Solicitudes
         TblSolicitud::create([
                    'id_proyecto'                     => $request->id_proyecto
                    ,'id_subproyecto'                 => $request->id_subproyecto
                    ,'id_viaje'                       => $request->id_viaje
                    ,'id_usuario'                     => $_SERVER['HTTP_USUARIO']
                    ,'id_empresa'                     => Session::get('business_id')
                    ,'solicitud_fecha_inicio'         => format_date_short($request->solicitud_fecha_inicio,'-')
                    ,'solicitud_fecha_fin'            => format_date_short($request->solicitud_fecha_fin,'-')
                    ,'solicitud_horario_inicio'       => $request->solicitud_horario_inicio
                    ,'solicitud_horario_fin'          => $request->solicitud_horario_fin
                    ,'solicitud_destino_inicio'       => $request->solicitud_destino_inicio
                    ,'solicitud_destino_final'        => $request->solicitud_destino_final
                ]);
                $result = [];
                #se obtiene el ultimo registro de la inserccion de la solicitud
                $where = ['created_at' => date("Y-m-d H:i:s") ];
                $data = TblSolicitud::where( $where )->get();
                if ( count($data) > 0 ) {

                    foreach ($data as $response) {
                        $result = [
                                'id_solicitud'                    => $response->id_solicitud
                                ,'id_proyecto'                    => $response->id_proyecto
                                ,'id_subproyecto'                 => $response->id_subproyecto
                                ,'id_viaje'                       => $response->id_viaje
                                ,'id_usuario'                     => $response->id_usuario
                                ,'id_empresa'                     => $response->id_empresa
                                ,'solicitud_fecha_inicio'         => $response->solicitud_fecha_inicio
                                ,'solicitud_fecha_fin'            => $response->solicitud_fecha_fin
                                ,'solicitud_horario_inicio'       => $response->solicitud_horario_inicio
                                ,'solicitud_horario_fin'          => $response->solicitud_horario_fin
                                ,'solicitud_destino_inicio'       => $response->solicitud_destino_inicio
                                ,'solicitud_destino_final'        => $response->solicitud_destino_final
                                ,'status'                         => $response->estatus
                            ]; 
                    }

                    if ( $result['id_solicitud'] ) {
                        #se manda a llamar el metodo para insertar acompañantes
                        $data = [
                            'id_solicitud'   => $result['id_solicitud']
                            ,'id_empresa'    => $result['id_empresa']
                            ,'acompanantes'  => $request->acompanantes 
                        ];
                        $respuesta = json_to_object(AcompananteController::guardar( array_to_object($data) ) );
                        if ($respuesta->success == true) {
                            return message(true,$result['id_solicitud'],'Transaccion Exitosa');
                        }else{
                            return ['success' => false, 'menssage' => "Ocurrio un Error en Insertar Los Acompañantes!"];
                        }

                    }else{
                        return ['success' => false, 'menssage' => "Ocurrio un Error en Insertar Solicitudes!"];
                    }

                }

    }
    /**
     *Metodo para visualizar las solicitudes por medio de un filtro estatus
     *@access public 
     *@param Request $request [Description] 
     *@return json
     */
    public function filtro_estatus( Request $request ){

        $where = [
            'id_empresa'    =>  Session::get('business_id')
            ,'id_usuario'   =>  $_SERVER['HTTP_USUARIO']
           # ,'estatus'      =>  $request->estatus
        ];
        $condicion = ( $request->estatus != "Todos" )? array_merge($where, ['estatus'=>$request->estatus]): $where ;
        $response = json_to_object(TblSolicitud::solicitudes_pendientes( $condicion ) );
        
        $registros = [];
        if ( $response->success  == true ) {
            $i = 1;
            foreach ( $response->result as $response) {
                
                $params = ['id_solicitud' => $response->id_solicitud];
                $cancel = ( $response->estatus == "Cancelado" || $response->estatus == "Enviado")? ' disabled ': false;
                $registros[] = [

                    'id_proyecto'                       =>  $response->proyecto
                    ,'id_subproyecto'                   =>  $response->subproyecto
                    ,'id_viaje'                         =>  $response->viaje
                    ,'solicitud_fecha_inicio'           =>  $response->solicitud_fecha_inicio
                    ,'solicitud_fecha_fin'              =>  $response->solicitud_fecha_fin
                    ,'solicitud_destino_final'          =>  $response->solicitud_destino_final
                    ,'status'                           =>  $response->estatus
                    ,'total'                            =>  format_currency($response->total)
                    ,'editar'                         =>  build_acciones_usuario(['id'=> $response->id_solicitud],'detail_solicitud',"",'btn btn-info',"fa fa-pencil-square",'data-toggle="tooltip" title="Detalles Solicitud"'.$cancel)
                    ,'enviar'                                 => build_acciones_usuario(['id'=> $response->id_solicitud],'send_solicitud',"",'btn btn-primary',"fa fa-paper-plane-o",'data-toggle="tooltip" title="Enviar Solicitud"'.$cancel)
                    ,'borrar'                                 => build_acciones($params,'cancel_solicitud',"",'btn btn-danger',"fa fa-trash",'data-toggle="tooltip" title="Cancelar Solicitud"'.$cancel)
                ];

                $i++;
            }

        }

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
                ,'registros'    => $registros
                ,'class'        => "table table-hover table-striped table-response"
                ,'class_thead'   => "head"
        );

        $data = [
            'tabla_solicitudes' => data_table_general($table)
            ,'ruta'             => route('solicitud_viaje')
            ,'return'           => route('authorization_travel')
        ];

        return view( 'solicitud.solicitud_usuario_viaje',$data );

    }
    /**
     *Metodo para visualizar las solicitudes pendientes
     *@access public 
     *@return html
     */
    public function solicitudes_pendientes(){

        #SE REALIZA LA CONULTA CON SUS JOIN DE SOLICITUDES
        $where = [
            'id_empresa' =>  Session::get('business_id')
            ,'id_usuario' => $_SERVER['HTTP_USUARIO']
        ];
        #$response = json_to_object(TblSolicitud::solicitudes_pendientes( $where ));
        $url = 'http://'.$this->_domain.'/api/travel/solicitudes?id_empresa='.Session::get('business_id').'&id_usuario='.$_SERVER['HTTP_USUARIO'];
        $headers = [ 
            'Content-Type'  => 'application/json'
            ,'usuario'      => $_SERVER['HTTP_USUARIO']
            ,'token'        => $_SERVER['HTTP_TOKEN']
        ];
        $data = [];
        $method = "get";
        $response = self::endpoint($url,$headers,$data,$method);
        $registros = [];
        if ( $response->success  == true ) {
            $i = 1;
            foreach ( $response->result as $response) {

                $params  = ['id_solicitud' => $response->id_solicitud];
                $cancel  = ( $response->status == "Cancelado" || $response->status == "Enviado")? ' disabled ': false;
                #$enviado = ( $response->status == "Enviado" )? ' disabled ': false;
                $registros[] = [

                    'id_proyecto'                       =>  $response->proyecto
                    ,'id_subproyecto'                   =>  $response->subproyecto
                    ,'id_viaje'                         =>  $response->viaje
                    ,'solicitud_fecha_inicio'           =>  $response->solicitud_fecha_inicio
                    ,'solicitud_fecha_fin'              =>  $response->solicitud_fecha_fin
                    ,'solicitud_destino_final'          =>  $response->solicitud_destino_final
                    ,'status'                           =>  $response->status
                    ,'total'                            =>  format_currency($response->total)
                    ,'editar' =>  build_acciones_usuario(['id'=> $response->id_solicitud],'detail_solicitud',"",'btn btn-info',"fa fa-pencil-square",'data-toggle="tooltip" title="Editar Solicitud"'.$cancel)
                    ,'enviar' => build_acciones_usuario(['id'=> $response->id_solicitud],'send_solicitud',"",'btn btn-primary',"fa fa-paper-plane-o",'data-toggle="tooltip" title="Enviar Solicitud"'.$cancel)
                    ,'borrar' => build_acciones($params,'cancel_solicitud',"",'btn btn-danger',"fa fa-trash",'data-toggle="tooltip" title="Cancelar Solicitud" '.$cancel)
                ];

                $i++;
            }

        }

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
                ,'registros'    => $registros
                ,'class'        => "table table-hover table-striped table-response"
                ,'class_thead'   => ""
        );

        $data = [
            'tabla_solicitudes' => data_table_general($table)
            ,'ruta'             => route('solicitud_viaje')
            ,'return'           => route('authorization_travel')
        ];
        return view( 'solicitud.solicitud_usuario_viaje',$data );

    }
    /**
     *Metodo para obtener los registros de la solicitud por su id_soliciud por medio del servicio
     *@access public 
     *@param Request $request [description]
     *@return void
     */
    public function consulta_solicitud( Request $request ){
        #SE REALIZA LA CONSULTA PARA OBTENER TODOS LOS VIATICOS
        $where = [
                'id_empresa'     =>  Session::get('business_id')
                ,'id_usuario'    =>  $_SERVER['HTTP_USUARIO']
                ,'id_solicitud'  =>  $request->id_solicitud
            ];
        $url = 'http://'.$this->_domain.'/api/travel/solicitudes?id_empresa='.Session::get('business_id').'&id_usuario='.$_SERVER['HTTP_USUARIO'].'&id_solicitud='.$request->id_solicitud;
        $headers = [ 
            'Content-Type'  => 'application/json'
            ,'usuario'      => $_SERVER['HTTP_USUARIO']
            ,'token'        => $_SERVER['HTTP_TOKEN']
        ];
        $data = [];
        $method = "get";
        $solicitud  = self::endpoint($url,$headers,$data,$method);
        $viaticos   = json_to_object(CatViaticoDetalle::viaticos_by_id( $where ));
        $montos     = json_to_object(CatSolicitudMonto::montos_by_id( $where ));

        $result_solicitud = [];
        $result_viaticos = [];
        $result_montos = [];
        $result_acompanantes = [];
        if ( $solicitud->success == true ) {

            foreach ($solicitud->result as $response) {

                $result_solicitud = [

                    'id_solicitud'                  => $response->id_solicitud
                    ,'id_proyecto'                  => $response->id_proyecto
                    ,'id_subproyecto'               => $response->id_subproyecto
                    ,'id_viaje'                     => $response->id_viaje
                    ,'id_usuario'                   => $response->id_usuario
                    ,'id_empresa'                   => $response->id_empresa
                    ,'solicitud_fecha_inicio'       => format_date($response->solicitud_fecha_inicio)
                    ,'solicitud_fecha_fin'          => format_date($response->solicitud_fecha_fin)
                    ,'solicitud_horario_inicio'     => $response->solicitud_horario_inicio
                    ,'solicitud_horario_fin'        => $response->solicitud_horario_fin
                    ,'solicitud_destino_inicio'     => $response->solicitud_destino_inicio
                    ,'solicitud_destino_final'      => $response->solicitud_destino_final
                    ,'total'                        => $response->total

                ];

                $result_acompanantes = [
                    'id_acompanante' => isset($response->acompanantes->id_acompañante)? $response->acompanantes->id_acompañante : []
                ];
                
            }

        }
        #if ( count($viaticos) > 0  ) {
        if ( $viaticos->success == true  ) {
            
            foreach ($viaticos->result as $response) {

                $result_viaticos[] = [
                    #'etiqueta_nombre'                   => MasterModel::show_model(['etiqueta_nombre'],['id_etiqueta' => $response->id_viatico],new TblEtiqueta)[0]->etiqueta_nombre
                    'etiqueta_nombre'                   => $response->etiqueta_nombre
                    ,'total'                            => format_currency($response->total)

                ];
                
            }

        }
        #if ( count($montos) > 0 ) {
        if ( $montos->success == true ) {
            #$monto_viatico_total = 0;
            foreach ($montos->result as $response) {

                $result_montos[] = [
                    'monto_tipo_solicitud'            => $response->monto_tipo_solicitud
                    ,'monto_tipo_pago'                => $response->monto_tipo_pago
                    ,'monto_importe'                  => $response->monto_importe
                    #,'monto_viatico_total'            => format_currency($monto_viatico_total += $response->monto_importe)
                    ,'monto_viatico_total'            => format_currency($response->monto_viatico_total)
                    ,'monto_importe_autorizado'       => $response->monto_importe_autorizado

                ];
                
            }


        }

        $data = [
                   'solicitud'       => $result_solicitud
                  ,'viaticos'        => $result_viaticos
                  ,'montos'          => $result_montos
                  ,'acompanantes'    => implode(',', $result_acompanantes['id_acompanante'] )
                ];
                
        return message(true,$data,'Transaccion Exitosa');
        #return json_encode( $data );

    }
    /**
     *Metodo actualizar el status de la solicitud para que lo pueda vizualizar el autorizador correspondiente.
     *@access public 
     *@param Request $request [description]
     *@return void
     */
    public function send_solicitud( Request $request ){
        #se debe mandar el id_solicitud para poder actualizar el estatus a enviado solicitud
        $where['id_empresa']    =  Session::get('business_id');
        $where['id_solicitud']  =  $request->id_solicitud;
        $id_usuario = false;
        if ($this->_tipo_user = 21) {
            $id_usuario = '&id_usuario='.$_SERVER['HTTP_USUARIO'];
        }
        $url = $this->_http.'://'.$this->_domain.'/api/travel/solicitudes?id_empresa='.Session::get('business_id').$id_usuario.'&id_solicitud='.$request->id_solicitud;
        $headers = [ 
            'Content-Type'  => 'application/json'
            ,'usuario'      => $_SERVER['HTTP_USUARIO']
            ,'token'        => $_SERVER['HTTP_TOKEN']
        ];
        $data = [];
        $method = "get";
        $solicitud  = self::endpoint($url,$headers,$data,$method);
        $estatus = "Enviado";
        if( isset( $solicitud->result )){
            #aqui se envia la informacion en el endpoint proporcionado.
            $url        = 'https://cpainbox.cpavision.mx/bpm/authorization/approve';
            $header    = ['Content-Type'  => 'application/json']; 
            $data       = [
                'id_solicitud' => $solicitud->result[0]->id_solicitud
                ,'estatus'     => $estatus
            ]; 
            $method     = 'post'; 
            $cpainbox   = self::endpoint($url,$header,$data,$method);
            if ($cpainbox->success != true) {
                return message(false,[],"No se envio la informacion correctamente");   
            }
        }
        $url = $this->_http.'://'.$this->_domain.'/api/travel/solicitudes';
        $datos = ['data' => [ 
                            'id_solicitud'  => $request->id_solicitud 
                            ,'estatus'      => $estatus
                        ]
                ];
        $method = 'put';
        $solicitud_update  = self::endpoint($url,$headers,$datos,$method);
        if ($solicitud_update->success == true) {
            return message($solicitud_update->success,[],"Los datos fueron enviados correctamente");
        }else{
            return message(false,[],'Ocurrio un error en enviar la solicitud');
        }

    }
    /**
     *Metodo controller para cancelar la solicitud
     *@access public 
     *@param Request $request [description]
     *@return void
     */
    public function cancel_solicitud( Request $request ){

        #se debe mandar el id_solicitud para poder actualizar el estatus a Procesando solicitud
        $where = ['id_solicitud' => $request->id_solicitud ];
        $datos = ['estatus' => 'Cancelado'];
        TblSolicitud::where( $where )->update($datos);
        return json_encode(['success' => true, 'message' => "Transaccion Exitosa" ]);

    }

}
