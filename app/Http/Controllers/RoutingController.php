<?php

namespace App\Http\Controllers;

#use App\Http\Controllers;
use Illuminate\Http\Request;
use App\Model\Apirest\TblSolicitud;
use Illuminate\Support\Facades\Session;
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
                    ,'/comprobantes/menus'          => 'comprobantes'
                    ,'/configuracion'               => 'configuracion'
                ]
            ,19 => [
                    '/business/process'             => 'businessProcess'
                    ,'/authorization'               => 'viaje_authorization'
                    ,'/policies'                    => 'policies'
                    ,'/pending'                     => 'pending'
                    ,'/account/status'              => 'accountStatus'
                    ,'/registration/conciliation'   => 'registrationConciliation'
                    ,'/comprobantes/menus'          => 'comprobantes'
                ]
            ,44 => [
                    '/business/process'             => 'businessProcess'
                    ,'/authorization'               => 'viaje_authorization'
                    ,'/policies'                    => 'policies'
                    ,'/pending'                     => 'pending'
                    ,'/account/status'              => 'accountStatus'
                    ,'/registration/conciliation'   => 'registrationConciliation'
                    ,'/comprobantes/menus'          => 'comprobantes'
                ]
            ,45 => [
                    '/business/process'             => 'businessProcess'
                    ,'/authorization'               => 'viaje_authorization'
                    ,'/policies'                    => 'policies'
                    ,'/pending'                     => 'pending'
                    ,'/account/status'              => 'accountStatus'
                    ,'/registration/conciliation'   => 'registrationConciliation'
                    ,'/comprobantes/menus'          => 'comprobantes'
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
                #,"carga_vista_html('pendientes','business/process')"
                ,"carga_vista_html('configuracion','business/process')"
            ];

            $images = [

                asset('images/menu/creacion_proyectos.png')
                ,asset('images/menu/autorizacion_viaje.png')
                ,asset('images/menu/autorisacion_comprobacion.png')
                #,asset('images/menu/autorizacion_pendientes.png')
                ,asset('images/menu/autorizacion_pendientes.png')
            ];
            $titulo = [
                'Creación de proyectos, subproyectos y viajes.'
                ,'Autorización del viaje.'
                ,'Autorización de comprobación del viaje.'
                #,'Autorizaciones pendientes'
                ,'Asignacion de Autorizadores'
            ];
            $data = [
                'titulo_principal'   => 'Proceso de Negocio'
                ,'bloque_vista'      => build_vista( $event, $images, $titulo )
            ];

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
            #,'ruta'         => route('solicitud_viaje_pendiente')
            #,'return'       => route('business_process')
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
     *Metodo donde se encaga de mandar a la vista de estados de cuenta
     *@access public
     *@return view 
     */
    public static function comprobantes( Request $request ){

            $event = [
                    "carga_vista_html('estadoscuenta','comprobantes/menus')"
                    ,"carga_vista_html('comprobantes/busqueda','comprobantes/menus')"
                    ,"carga_vista_html('comprobantes/nocfdi','comprobantes/menus')"
                    ,"carga_vista_html('','comprobantes/menus')"
                ];

            $images = [
                asset('images/menu/creacion_proyectos.png')
                ,asset('images/menu/creacion_proyectos.png')
                ,asset('images/menu/creacion_proyectos.png')
                ,asset('images/menu/creacion_proyectos.png')
            ];
            $titulo = [
                'Estados de Cuenta'
                ,'Busqueda CFDI'
                ,'No CFDI'
                ,'Notas'
            ];
            $data = [
                'titulo_principal'   => 'CFDI FACTURACION'
                ,'bloque_vista'      => build_vista( $event, $images, $titulo )
            ];

            return view('menus.menu_principal',$data);
    }
    


}
