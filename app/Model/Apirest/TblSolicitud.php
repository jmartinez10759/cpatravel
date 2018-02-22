<?php

namespace App\Model\Apirest;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Web\AcompananteController;

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
    	
        #debuger($where);
    	$id_solicitud = (isset( $where['id_solicitud'] ))? ' AND ts.id_solicitud = :id_solicitud' : false;
    	$estatus = (isset( $where['estatus'] ))? ' AND ts.estatus = :estatus' : false;
        #$group = ( isset( $where['group'] ) )? 'GROUP BY ts.id_solicitud' : false;
    	$response = DB::select('
			    				SELECT 
								ts.*
                                ,te.etiqueta_nombre
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
                                #,csc.id_usuario as id_acompanante
								FROM tbl_solicitudes ts
								LEFT JOIN tbl_proyectos tp on ts.id_proyecto = tp.id_proyecto
								LEFT JOIN tbl_subproyectos tsub on ts.id_subproyecto = tsub.id_subproyecto
								LEFT JOIN tbl_viajes tv on ts.id_viaje = tv.id_viaje
								LEFT JOIN cat_viaticos_detalles cvt on ts.id_solicitud = cvt.id_solicitud
								AND ts.id_usuario = cvt.id_usuario
								AND ts.id_empresa = cvt.id_empresa
                                LEFT JOIN tbl_etiquetas te ON cvt.id_viatico = te.id_etiqueta
                                AND  cvt.id_empresa = te.id_empresa
								LEFT JOIN cat_solicitudes_montos csm on ts.id_solicitud = csm.id_solicitud
								and ts.id_usuario = csm.id_usuario
								and ts.id_empresa = csm.id_empresa
								AND cvt.id_viatico = csm.id_viatico
								AND cvt.id_detalle = csm.id_detalle
                                #LEFT JOIN cat_solicitudes_companion csc on ts.id_solicitud = csc.id_solicitud
                                #AND ts.id_empresa = csc.id_empresa
								WHERE ts.id_empresa = :id_empresa AND ts.id_usuario = :id_usuario'.$id_solicitud.''.$estatus.'
								GROUP BY ts.id_solicitud 
                                ORDER BY ts.id_solicitud DESC',$where
							);

    	if ( count($response) > 0) {
    		return json_encode( ['success' => true, 'result' => $response] );
    	}else{
    		return json_encode(['success' => false, 'result' => [] ]);
    	}


    }
    /**
     *Metodo model para la creacion de unicamanente de la solicitud y acompañantes
     *@access public
     *@param Request $request [Description]
     *@return json
     */
    public static function save_solicitud_model( $request ){

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
                        $data = [
                            'id_solicitud'   => $result['id_solicitud']
                            ,'id_empresa'    => $result['id_empresa']
                            ,'acompanantes'  => $request->acompanantes 
                        ];
                        $respuesta = json_to_object(AcompananteController::guardar( array_to_object($data) ) );
                        if ($respuesta->success == true) {
                            return message(true,$result,'Transaccion Exitosa');
                        }else{
                            return ['success' => false, 'menssage' => "Ocurrio un Error en Insertar Los Acompañantes!"];
                        }

                    }else{
                        return ['success' => false, 'menssage' => "Ocurrio un Error en Insertar Solicitudes!"];
                    }


                }

    }
    /**
     *Metodo model para la consulta de todas las solicitudes.
     *@access public
     *@param $where array [Description]
     *@return json
     */
    public static function solicitudes_model( $where = array() ){

        $id_proyecto     = ( !empty($where['id_proyecto']) )? 'AND ts.id_proyecto= :id_proyecto ':false;
        $id_subproyecto  = ( !empty($where['id_subproyecto']) )? 'AND ts.id_subproyecto= :id_subproyecto ' :false;
        $id_viaje        = ( !empty($where['id_viaje']) )? 'AND ts.id_viaje= :id_viaje ' :false;
        $id_etiqueta     = ( !empty($where['id_etiqueta']) )? 'AND te.id_etiqueta= :id_etiqueta ' :false;
        $fecha_inicio    = ( !empty($where['solicitud_fecha_inicio']) )? 'AND ts.solicitud_fecha_inicio BETWEEN :solicitud_fecha_inicio AND :solicitud_fecha_fin' :false;
        $id_usuario     =  ( !empty($where['id_usuario']) || isset( $where['id_usuario'] ) )? 'AND ts.id_usuario= :id_usuario ' :false;
        #debuger();
        $query = 'SELECT 
                    ts.*
                    ,tp.nombre as proyecto 
                    ,tsub.nombre as subproyecto
                    ,tv.nombre as viaje
                    ,te.etiqueta_nombre
                    ,cvt.viatico_cantidad
                    ,cvt.viatico_unidad
                    ,cvt.viatico_costo_unitario
                    ,csm.monto_tipo_solicitud
                    ,csm.monto_tipo_pago
                    ,csm.monto_importe_autorizado
                    FROM tbl_solicitudes ts
                    LEFT JOIN tbl_proyectos tp on ts.id_proyecto = tp.id_proyecto
                    LEFT JOIN tbl_subproyectos tsub on ts.id_subproyecto = tsub.id_subproyecto
                    LEFT JOIN tbl_viajes tv on ts.id_viaje = tv.id_viaje
                    LEFT JOIN cat_viaticos_detalles cvt on ts.id_solicitud = cvt.id_solicitud                             
                    AND ts.id_usuario = cvt.id_usuario
                    AND ts.id_empresa = cvt.id_empresa
                    LEFT JOIN tbl_etiquetas te ON cvt.id_viatico = te.id_etiqueta
                    AND  cvt.id_empresa = te.id_empresa
                    LEFT JOIN cat_solicitudes_montos csm on ts.id_solicitud = csm.id_solicitud
                    AND ts.id_usuario = csm.id_usuario
                    AND ts.id_empresa = csm.id_empresa
                    AND cvt.id_viatico = csm.id_viatico
                    AND cvt.id_detalle = csm.id_detalle
                    WHERE ts.id_empresa = :id_empresa 
                    '.$id_usuario.' '.$id_proyecto.' '.$id_subproyecto.' '.$id_viaje.' '.$id_etiqueta
                    .'ORDER BY ts.id_solicitud DESC';

        $response = DB::select( $query,$where );

        if ( count($response) > 0) {
            return json_encode( ['success' => true, 'result' => $response] );
        }else{
            return json_encode(['success' => false, 'result' => [] ]);
        }


    }

}
