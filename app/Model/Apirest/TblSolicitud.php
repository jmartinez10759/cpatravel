<?php

namespace App\Model\Apirest;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class TblSolicitud extends Model
{
    protected $table = "tbl_solicitudes";
    public $fillable = [
    	'id_solicitud'
		,'id_proyecto'
		,'id_subproyecto'
		,'id_viaje'
		,'id_usuario'
		,'id_empresa'
		,'solicitud_fecha_inicio'
		,'solicitud_fecha_fin'
		,'solicitud_horario_inicio'
		,'solicitud_horario_fin'
		,'solicitud_destino_inicio'
		,'solicitud_destino_final'
		,'estatus'
    ];
    /**
     *Metodo modelo para hacer la consulta de todos los registros de las solicitudes
     *@access public
     *@param $where array [description]
     *@return json
     */
    public static function solicitudes_pendientes( $where = array() ){
    	
    	$id_solicitud = (isset( $where['id_solicitud'] ))? ' AND ts.id_solicitud = :id_solicitud' : false;
    	$estatus = (isset( $where['estatus'] ))? ' AND ts.estatus = :estatus' : false;

    	$response = DB::select('
			    				SELECT 
								ts.*
                                ,cvt.viatico_cantidad
                                ,cvt.viatico_unidad
                                ,cvt.viatico_costo_unitario
                                ,csm.monto_tipo_solicitud
                                ,csm.monto_tipo_pago
                                ,csm.monto_importe_autorizado
								,SUM(csm.monto_importe) as total
								,tp.nombre as proyecto
								,tsub.nombre as subproyecto
								,tv.nombre as viaje
                                ,csc.id_usuario as id_acompanante
								FROM tbl_solicitudes ts
								LEFT JOIN tbl_proyectos tp on ts.id_proyecto = tp.id_proyecto
								LEFT JOIN tbl_subproyectos tsub on ts.id_subproyecto = tsub.id_subproyecto
								LEFT JOIN tbl_viajes tv on ts.id_viaje = tv.id_viaje
								LEFT JOIN cat_viaticos_detalles cvt on ts.id_solicitud = cvt.id_solicitud
								AND ts.id_usuario = cvt.id_usuario
								AND ts.id_empresa = cvt.id_empresa
								LEFT JOIN cat_solicitudes_montos csm on ts.id_solicitud = csm.id_solicitud
								and ts.id_usuario = csm.id_usuario
								and ts.id_empresa = csm.id_empresa
								AND cvt.id_viatico = csm.id_viatico
								AND cvt.id_detalle = csm.id_detalle
                                LEFT JOIN cat_solicitudes_companion csc on ts.id_solicitud = csc.id_solicitud
                                AND ts.id_empresa = csc.id_empresa
								WHERE ts.id_empresa = :id_empresa AND ts.id_usuario = :id_usuario'.$id_solicitud.''.$estatus.'
								GROUP BY ts.id_solicitud',$where
							);
    	if ( count($response) > 0) {

    		return json_encode( ['success' => true, 'result' => $response] );

    	}else{
    		
    		return json_encode(['success' => false, 'result' => [] ]);

    	}


    }
    /**
     *Metodo para la creacion de unicamanente de la solicitud
     *@access public
     *@param Request $request [Description]
     *@return json
     */
    public static function save_solicitud( $request ){

        #se cargan los datos para mandarlos a insertar a la tabla de Solicitudes
         $data = [
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
                ];
         TblSolicitud::create($data);
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
                        return json_encode( ['success' => true, 'result' => $result ] );
                        /*$datos = [
                            'id_solicitud'  => $result['id_solicitud']
                            ,'id_empresa'    => $result['id_empresa']
                            ,'acompanantes'  => $request->acompanantes 
                        ];
                        $respuesta = json_to_object(AcompananteController::guardar( array_to_object($datos) ) );
                        if ($respuesta->success == true) {
                            return json_encode( ['success' => true, 'result' => $result ] );
                        }else{
                            return ['success' => false, 'menssage' => "Ocurrio un Error en Insertar Los Acompañantes!"];
                        }*/
                    }else{
                        return ['success' => false, 'menssage' => "Ocurrio un Error en Insertar Solicitudes!"];
                    }

                }

    }

    

}
