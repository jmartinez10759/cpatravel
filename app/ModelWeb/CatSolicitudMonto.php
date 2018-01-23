<?php

namespace App\ModelWeb;

use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class CatSolicitudMonto extends Model
{
    protected $table = "cat_solicitudes_montos";
    public $fillable = [
        'id_solicitud'
    	,'id_detalle'
        ,'id_viatico'
        ,'id_empresa'
        ,'id_usuario'
        ,'monto_tipo_solicitud'
        ,'monto_tipo_pago'
        ,'monto_importe'
        ,'monto_importe_autorizado'
        ,'status'
    ];
    /**
     *Metodo modelo consulta por medio de un id los montos
     *@access public
     *@param $where array [description]
     *@return void
     */
    public static function montos_by_id( $where = array() ){

        $id_solicitud = ( isset( $where['id_solicitud'] ) )? ' AND csm.id_solicitud = :id_solicitud' : false;
        $id_viatico   = ( isset( $where['id_viatico'] ) )? ' AND csm.id_viatico = :id_viatico' :false;
        $id_detalle   = ( isset( $where['id_detalle'] ) )? ' AND csm.id_detalle = :id_detalle' :false;

        $query = DB::select('SELECT 
                            csm.*
                            ,SUM(csm.monto_importe) as monto_viatico_total 
                            FROM cat_solicitudes_montos csm
                            WHERE csm.id_empresa = :id_empresa 
                                  AND csm.id_usuario = :id_usuario
                                  '.$id_solicitud.'
                                  '.$id_viatico.' 
                                  '.$id_detalle.' 
                            GROUP BY csm.monto_tipo_pago, csm.monto_tipo_solicitud',$where
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
     *Metodo para guardar los montos de los viaticos
     *@access public
     *@param $request object [description]
     *@return json
     */
    public static function save_montos( $request ){

        DB::beginTransaction();
        try {
            #inicio de la transaccion
                $insert = [];
                for ($i=0; $i < count( $request['monto_tipo_pago'] ); $i++) { 
                    $insert = [
                        'id_solicitud'                  => $request['id_solicitud']
                        ,'id_detalle'                   => $request['id_detalle']
                        ,'id_viatico'                   => $request['id_viatico']
                        ,'id_empresa'                   => $request['id_empresa']
                        ,'id_usuario'                   => $request['id_usuario']
                        ,'monto_tipo_solicitud'         => $request['monto_tipo_solicitud']
                        ,'monto_tipo_pago'              => $request['monto_tipo_pago'][$i]
                        ,'monto_importe'                => $request['monto_importe'][$i]
                        ,'monto_importe_autorizado'     => $request['monto_importe_autorizado']
                    ];
                    CatSolicitudMonto::create( $insert );
                }

                $result = [];
                $where = ['created_at' => date("Y-m-d H:i:s") ];
                $data = CatSolicitudMonto::where( $where )->get();
                if ( count($data) > 0 ) {
                    foreach ($data as $response) {

                        $result[] = [
                                'id_solicitud'                  => $response->id_solicitud
                                ,'id_detalle'                   => $response->id_detalle
                                ,'id_empresa'                   => $response->id_empresa
                                ,'id_usuario'                   => $response->id_usuario
                                ,'monto_tipo_solicitud'         => $response->monto_tipo_solicitud
                                ,'monto_tipo_pago'              => $response->monto_tipo_pago
                                ,'monto_importe'                => $response->monto_importe
                                ,'monto_importe_autorizado'     => $response->monto_importe_autorizado
                            ]; 

                    }

                }           

        }
        #Ha ocurrido un error, devolvemos la BD a su estado previo y hacemos lo que queramos con esa excepción
        catch (\Exception $e)
        {
            DB::rollback();
            #Informemos con un echo
            return json_encode(['success' => false, 'result' => $e->getMessage() ]);
        }
        #Hacemos los cambios permanentes ya que no hay errores
        DB::commit();
        return json_encode( ['success' => true, 'result' => $result ] ); 


    }
    


}
