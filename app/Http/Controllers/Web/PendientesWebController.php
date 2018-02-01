<?php

namespace App\Http\Controllers\Web;

use Session;
use Illuminate\Http\Request;
use App\Model\Apirest\TblSolicitud;
use App\Http\Controllers\Web\MasterWebController;

class PendientesWebController extends MasterWebController
{
    
	public function __construct(){

        parent::__construct();
        $this->session_expire();

    } 
    /**
     *Metodo Controller para ver una tabla de los pendientes de las solicitudes.
     *@access public 
     *@return void
     */
    public function index(){
        
        #se realiza una conulta por estatus para mostrar unicamante las solicitudes pendientes.
        $where = [
            'estatus'       => "Pendiente"
            ,'id_usuario'   => $_SERVER['HTTP_USUARIO']
            ,'id_empresa'   => Session::get('business_id')
        ];
        #debuger($where);
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
                    ,'editar'                           =>  build_acciones_usuario(['id'=> $response->id_solicitud],'detail_solicitud',"",'btn btn-info',"fa fa-pencil-square",false)
                    ,'enviar'                           => build_acciones_usuario(['id'=> $response->id_solicitud],'send_solicitud',"",'btn btn-primary',"fa fa-paper-plane-o",false)
                    ,'borrar'                           => build_acciones($params,'cancel_solicitud',"",'btn btn-danger',"fa fa-trash",false)
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
            'avatar'                => ( !is_null(Session::get('img') ) )? Session::get('img') : asset('images/avatar.jpeg')
            ,'usuario'              => Session::get('name')
            ,'table_pendientes'     => data_table_general($table)
        ];
        #debuger($datos);
        return view( 'process_bussines.autorizaciones.pendientes_auth',$datos );
    
    }

    
}
