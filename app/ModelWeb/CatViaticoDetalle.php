<?php

namespace App\ModelWeb;

use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class CatViaticoDetalle extends Model
{
    public $table = "cat_viaticos_detalles";
    public $fillable = [
    	'id_detalle'
        ,'id_solicitud'
        ,'id_viatico'
    	,'id_usuario'
        ,'id_empresa'
    	,'viatico_cantidad'
    	,'viatico_unidad'
        ,'viatico_costo_unitario'
    	,'status'
    ];
    /**
     *Metodo Model donde se realiza la consulta de los viaticos
     *@access public
     *@param
     *@return json
     */
    public static function consulta_group( $where = array() ){
       # debuger($where);
        $response = DB::select('SELECT 
                                cvd.*
                                #,sum(cvd.viatico_costo_unitario * cvd.viatico_cantidad * cvd.viatico_unidad) as viaticos_total
                                ,te.etiqueta_nombre
                                FROM cat_viaticos_detalles cvd
                                INNER JOIN tbl_etiquetas te on cvd.id_viatico = te.id_etiqueta
                                AND cvd.id_usuario = te.id_usuario
                                AND cvd.id_empresa = te.id_empresa
                                WHERE cvd.id_viatico = :id_viatico 
                                AND cvd.id_solicitud = :id_solicitud
                                AND cvd.id_usuario = :id_usuario
                                AND cvd.id_empresa = :id_empresa',$where
                            );

        if ( count($response) > 0 ) {
            return json_encode( $response );
        }else{
            return false;
        }

    }
    /**
     *Metodo modelo consulta por medio de un id los viaticos
     *@access public
     *@param $where array [description]
     *@return void
     */
    public static function viaticos_by_id( $where = array() ){
        
        $id_solicitud = ( isset( $where['id_solicitud'] ) )? ' AND cvd.id_solicitud = :id_solicitud' : false;
        $id_detalle   = ( isset( $where['id_detalle'] ) )? ' AND cvd.id_detalle = :id_detalle' :false;
        $id_viatico   = ( isset( $where['id_viatico'] ) )? ' AND cvd.id_viatico = :id_viatico' :false;
        
        $query = DB::select('SELECT 
                                cvd.*
                                ,te.etiqueta_nombre
                                ,SUM(cvd.viatico_costo_unitario * cvd.viatico_cantidad * cvd.viatico_unidad) as total
                                FROM cat_viaticos_detalles cvd
                                INNER JOIN tbl_etiquetas te ON cvd.id_viatico = te.id_etiqueta
                                AND cvd.id_usuario = te.id_usuario
                                AND cvd.id_empresa = te.id_empresa
                                WHERE cvd.id_empresa = :id_empresa 
                                    AND cvd.id_usuario = :id_usuario
                                    '.$id_solicitud.'
                                    '.$id_detalle.'
                                    '.$id_viatico.'
                                GROUP BY cvd.id_viatico',$where
                            );

        $response = [];
        if ( count($query) > 0 ) {
            $response['success'] = true;
            $response['result'] = $query;
        }else{
            $response['success'] = false;
            $response['result'] = []; 
        }
        return json_encode( $response );

    }
    /**
     *Metodo para la creacion de los registros de los viaticos
     *@access public 
     *@param Request $request [Description]
     *@return json
     */
    public static function save_viaticos( $request ){
        
        #Se realiza la inserccion de los datos de viaticos y montos.
        CatViaticoDetalle::create( $request );
        #se obtiene el ultimo registro de la inserccion de la solicitud
            $where = ['created_at' => date("Y-m-d H:i:s") ];
            $data = CatViaticoDetalle::where( $where )->get();
            $result = [];
            if ( count($data) > 0 ) {

                foreach ($data as $response) {
                    $result = [
                             'id_detalle'                     => $response->id_detalle  
                            ,'id_solicitud'                   => $response->id_solicitud
                            ,'id_viatico'                     => $response->id_viatico
                            ,'id_usuario'                     => $response->id_usuario
                            ,'id_empresa'                     => $response->id_empresa
                            ,'viatico_cantidad'               => $response->viatico_cantidad
                            ,'viatico_unidad'                 => $response->viatico_unidad
                            ,'viatico_costo_unitario'         => $response->viatico_costo_unitario
                            ,'status'                         => $response->status
                        ]; 
                }
                #Se manda a llamar un metodo donde se encarga de insertar los montos en formago se convierte en json 
                return json_encode( ['success' => true, 'result' => $result ] );
            }else{
                return json_encode( ['success' => false, 'result' => []] );
            }

    }
    /**
     *Metodo modelo para la actualizacion de los datos
     *@access public
     *@param $where array [description]
     *@param $datos array [description]
     *@return json
     */
    public static function actualizar ( $where = array(), $datos = array() ){

            $data = CatViaticoDetalle::where($where)->update($datos);
            $consulta = json_to_object(CatViaticoDetalle::viaticos_by_id($where));
            if ( $consulta->success == true ) {

                return json_encode(['success' => true, 'result' => $consulta->result ]);

            }

            return json_encode( ['success' => false , 'result' => [] ] );

    }
    


}
