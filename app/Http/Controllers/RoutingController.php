<?php

namespace App\Http\Controllers;

use Session;
use App\Label;
use App\Country;
use App\StatusAccount;
use App\Http\Controllers;
use Illuminate\Http\Request;
use App\Request as Solicitude;
use App\Model\Apirest\TblSolicitud;
use App\Http\Controllers\Web\MasterWebController;

class RoutingController extends MasterWebController
{
    //private $_permits;
    public function __construct(){
        parent::__construct();
        $this->session_expire();
        $this->index( new Request );
    }
    /**
     *Metodo controller donde se estable que metodo sera llamado
     *@access public 
     *@param Request $request
     *@return void
     */
    public function index( Request $request ){
        

        #esta parte se podria evitar si se trajeran los datos desde la DB por cada rol y/o usuario
        $method_path = [

            21 => [
                    '/business/process'             => 'businessProcess'
                    ,'/authorization'               => 'viaje_authorization'
                    ,'/policies'                    => 'policies'
                    ,'/pending'                     => 'pending'
                    ,'/account/status'              => 'accountStatus'
                    ,'/registration/conciliation'   => 'registrationConciliation'
                ]
            ,19 => [
                    '/business/process'             => 'businessProcess'
                    ,'/authorization'               => 'viaje_authorization'
                    ,'/policies'                    => 'policies'
                    ,'/pending'                     => 'pending'
                    ,'/account/status'              => 'accountStatus'
                    ,'/registration/conciliation'   => 'registrationConciliation'
                ]
            ,44 => [
                    '/business/process'             => 'businessProcess'
                    ,'/authorization'               => 'viaje_authorization'
                    ,'/policies'                    => 'policies'
                    ,'/pending'                     => 'pending'
                    ,'/account/status'              => 'accountStatus'
                    ,'/registration/conciliation'   => 'registrationConciliation'
                ]
            ,45 => [
                    '/business/process'             => 'businessProcess'
                    ,'/authorization'               => 'viaje_authorization'
                    ,'/policies'                    => 'policies'
                    ,'/pending'                     => 'pending'
                    ,'/account/status'              => 'accountStatus'
                    ,'/registration/conciliation'   => 'registrationConciliation'
                ]

        ] ;
        #se manda a llamar este metodo para la validacion de sus permisos y la session del sistema
        return self::tipo_accion( $method_path, get_class($this), $request );

    }

    /**
     *Metodo para mostrar la pantalla de la creeacion de los proyectos,subproyectos y viajes
     *@access public 
     *@return html
     */
    public static function businessProcess( Request $request ){
            #se manda a llamar el submenu principal con sus caracteristicas
            $event = [
                "carga_vista_html('proyecto','business/process')"
                ,"carga_vista_html('authorization','business/process')"
                ,"carga_vista_html('','business/process')"
                ,"carga_vista_html('pending','business/process')"
            ];

            $images = [
                asset('images/menu/creacion_proyectos.png')
                ,asset('images/menu/autorizacion_viaje.png')
                ,asset('images/menu/autorisacion_comprobacion.png')
                ,asset('images/menu/autorizacion_pendientes.png')
            ];
            $titulo = [
                'Creación de proyectos, subproyectos y viajes.'
                ,'Autorización del viaje.'
                ,'Autorización de comprobación del viaje.'
                ,'Autorizaciones pendientes'
            ];
            $data = [
                'titulo_principal'   => 'Proceso de Negocio'
                ,'bloque_vista'      => build_vista( $event, $images, $titulo )
            ];
            #return view('menus.business_processes',$data);
            return view('menus.menu_principal',$data);

    }
    /**
     *Metodo para autorizar los viajes 
     *@access public 
     *@return void
     */
    public static function viaje_authorization( Request $request ){

        $data = [
            'button1'       => "Solicitud de gastos de viaje"
            ,'button2'      => "Tranferencia de saldo"
            ,'ruta'         => route('solicitud_viaje_pendiente')
            ,'return'       => route('business_process')
        ];
        return view('menus.travel_authorization',$data);
    
    }
    /**
     *Metodo para cargar la vista de los menus de politicas
     *@access public 
     *@return html
     */
    public static function policies( Request $request ){

        $event = [
                "carga_vista_html('politicas','policies')"
                ,"carga_vista_html('','policies')"
                ,"carga_vista_html('','policies')"
            ];

            $images = [
                asset('images/menu/creacion_proyectos.png')
                ,asset('images/menu/autorizacion_viaje.png')
                ,asset('images/menu/autorisacion_comprobacion.png')
            ];
            $titulo = [
                'Etiquetas y Políticas de montos máximos.'
                ,'Definir cobro de gastos no comprobados'
                ,'Asientos contables'
            ];
            $data = [
                'titulo_principal'   => 'Menu de Politicas'
                ,'bloque_vista'      => build_vista( $event, $images, $titulo )
            ];
        return view('menus.menu_principal',$data);
        #return view('politicas.menu_politicas',$data);
    
    }
    /**
     *Metodo para la carga del submenu principal
     *@access public
     *@return void
     */
    public static function registrationConciliation( Request $request ){

            $event = [
                "carga_vista_html('','registration/conciliation')"
                ,"carga_vista_html('','registration/conciliation')"
            ];

            $images = [
                asset('images/menu/creacion_proyectos.png')
                ,asset('images/menu/autorisacion_comprobacion.png')
            ];
            $titulo = [
                'Historial de Registros'
                ,'Aplicar cobro de gastos no comprobados'
            ];
            $data = [
                'titulo_principal'   => 'Menú de Registros y Conciliación'
                ,'bloque_vista'      => build_vista( $event, $images, $titulo )
            ];

            return view('menus.menu_principal',$data);
        #return view('conciliacion.menu_conciliacion',$data);
    }
    /**
     *Metodo para ver una tabla de los pendientes de las solicitudes.
     *@access public 
     *@return void
     */
    public static function pending( Request $request ){
    
        $data= Solicitude::where('status',2)->where('user_id',Session::get('user_id'))->get();
        $modeladoStage = ServiciosController::getStateBusiness($state = 1)->getData();
        #return view('authorizations.pending',compact('data','modeladoStage'));
        #se realiza una conulta por estatus para mostrar unicamante las solicitudes pendientes.
        $where = [
            'estatus'       => "Pendiente"
            ,'id_usuario'   => $_SERVER['HTTP_USUARIO']
            ,'id_empresa'   => Session::get('business_id')
        ];
        $response = json_to_object(TblSolicitud::solicitudes_pendientes( $where ) );
        #debuger($response);
        $registros = [];
        if ( $response->success  == true ) {
            $i = 1;
            foreach ( $response->result as $response) {
                
                $params = ['id_solicitud' => $response->id_solicitud];
                $registros[] = [

                    'id_proyecto'                       =>  $response->proyecto
                    ,'id_subproyecto'                   =>  $response->subproyecto
                    ,'id_viaje'                         =>  $response->viaje
                    ,'solicitud_fecha_inicio'           =>  $response->solicitud_fecha_inicio
                    ,'solicitud_fecha_fin'              =>  $response->solicitud_fecha_fin
                    ,'solicitud_destino_final'          =>  $response->solicitud_destino_final
                    ,'status'                           =>  $response->estatus
                    ,'total'                            =>  format_currency($response->total)
                    ,'editar'                         =>  build_acciones_usuario(['id'=> $response->id_solicitud],'detail_solicitud',"",'btn btn-info',"fa fa-pencil-square",false)
                    ,'enviar'                                 => build_acciones_usuario(['id'=> $response->id_solicitud],'send_solicitud',"",'btn btn-primary',"fa fa-paper-plane-o",false)
                    ,'borrar'                                 => build_acciones($params,'cancel_solicitud',"",'btn btn-danger',"fa fa-trash",false)
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
                ,'class_thead'  => "head"
        );



        $datos = [
            'data' => $data
            ,'modeladoStage' => $modeladoStage
            ,'avatar'               => ( !is_null(Session::get('img') ) )? Session::get('img') : asset('images/avatar.jpeg')
            ,'usuario'              => Session::get('name')
            ,'table_pendientes'     => data_table_general($table)
        ];
        return view( 'process_bussines.autorizaciones.pendientes_auth',$datos );
    
    }
    /**
     *Metodo donde se encaga de mandar a la vista de estados de cuenta
     *@access public
     *@return view 
     */
    public static function accountStatus( Request $request ){

        $data = [
            'titulo_principal' => "Estados de Cuenta"
            ,'avatar'          => ( !is_null(Session::get('img') ) )? Session::get('img') : asset('images/avatar.jpeg')
            ,'usuario'         => Session::get('name')
        ];

        return view('account.estados_cuenta',$data);
    
    }
    


}
