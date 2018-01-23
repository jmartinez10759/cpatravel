<?php

namespace App\Http\Controllers\Web;

use Session;
use App\Label;
use App\Country;
use App\StatusAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\ModelWeb\CatSolicitudMonto;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\Web\MasterWebController;

class MontoSolicitudController extends MasterWebController
{
    private $_permits;
    
    public function __construct(){
        parent::__construct();
        $this->_permits=  self::verify_permison();
    }
    /**
     *Metodo para realizar la consulta de los montos por medio de id_viaticos
     *@access public
     *@param  Request $request [Description]
     *@return json
     */
    public function show(  $request ){

    	$datos = [
    		'id_viatico'    =>  $request->id_viatico
            ,'id_usuario'   =>  $_SERVER['HTTP_USUARIO']
            ,'id_empresa'   =>  Session::get('business_id')
            ,'id_solicitud' =>  ( isset( $request->id_solicitud ) )? $request->id_solicitud : 0
    	];

    	$response = CatSolicitudMonto::where($datos)->get();
    	if (count( $response ) > 0) {
    		$data = [];
    		foreach ($response as $result) {
    			$data[] = [
			    	'id_solicitud'					=> $result->id_solicitud
			        ,'id_viatico'					=> $result->id_viatico
			        ,'monto_tipo_solicitud'			=> $result->monto_tipo_solicitud
			        ,'monto_tipo_pago'				=> $result->monto_tipo_pago
			        ,'monto_importe'				=> $result->monto_importe
			        ,'monto_importe_autorizado'		=> $result->monto_importe_autorizado
    			];

    		}
    		return $data;


    	}


    }
    /**
     *Metodo para guardar los montos de los viaticos
     *@access public
     *@param $request object [description]
     *@return json
     */
    public static function guardar( $request ){

        DB::beginTransaction();
        try {
            #inicio de la transaccion
                $insert = [];
                for ($i=0; $i < count( $request->monto_tipo_pago ); $i++) { 
                    
                    $insert = [
                        'id_solicitud'                  => $request->id_solicitud
                        ,'id_viatico'                   => $request->id_viatico
                        ,'id_empresa'                   => Session::get('business_id')
                        ,'id_usuario'                   => $_SERVER['HTTP_USUARIO']
                        ,'monto_tipo_solicitud'         => $request->monto_tipo_solicitud
                        ,'monto_tipo_pago'              => $request->monto_tipo_pago[$i]
                        ,'monto_importe'                => $request->monto_importe[$i]
                        ,'monto_importe_autorizado'     => $request->monto_importe_autorizado
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
        return json_encode( ['success' => true, 'result' => $result] ); 


    }
    /**
     *Metodo para Consultar sus montos y formas de pago por viatico
     *@access public
     *@param $request object [description]
     *@return json
     */
    public static function detalles( $request ){

        $datos = [
            
            'id_detalle'   =>  $request->id_detalle
            ,'id_viatico'    =>  $request->id_viatico
            ,'id_usuario'   =>  $_SERVER['HTTP_USUARIO']
            ,'id_empresa'   =>  Session::get('business_id')
            ,'id_solicitud' =>  ( isset( $request->id_solicitud ) )? $request->id_solicitud : ""

        ];

        $response = json_to_object(CatSolicitudMonto::montos_by_id( $datos ) );
        #debuger($response);
        $data = [];
        if (  $response->success ==true ) {
            $monto_importe_total = 0;
            foreach ($response->result as $result) {

                $data[] = [

                    'id_solicitud'                  => $result->id_solicitud
                    ,'id_detalle'                   => $result->id_detalle
                    ,'id_viatico'                   => $result->id_viatico
                    ,'monto_tipo_solicitud'         => $result->monto_tipo_solicitud
                    ,'monto_tipo_pago'              => $result->monto_tipo_pago
                    ,'monto_importe'                => $result->monto_importe
                    ,'monto_viatico_total'          => $result->monto_viatico_total
                    ,'monto_importe_autorizado'     => $result->monto_importe_autorizado
                ];

            }
            return json_encode( ['success' => true, 'result' => $data ] );

        }
            return json_encode( ['success' => false, 'result' => $data ] );



    }
    /**
     *Metodo para Consultar sus montos y formas de pago por viatico
     *@access public
     *@param $request object [description]
     *@return json
     */
    public static function borrar( $where ){

        CatSolicitudMonto::where( $where )->delete();
        return json_encode(['success' => true]);

    }
    /**
     *Metodo para actualizar los registros de los montos
     *@access public 
     *@param  $where [Description]
     *@param  $request [Description]
     *@return json
     */
    public static function actualizar ( $where =array() , $request = array() ){
            #debuger($where);
        for ($i=0; $i < count( $request['monto_importe'] ); $i++) { 
                    
                $data = [
                    'monto_tipo_solicitud'          =>  $request['monto_tipo_solicitud']
                    //,'monto_tipo_pago'              =>  $request['monto_tipo_pago'][$i]
                    ,'monto_importe'                =>  $request['monto_importe'][$i]
                    ,'monto_importe_autorizado'     =>  $request['monto_importe_autorizado']
                ];
            #debuger($update);
                $condicion = [
                    'id_detalle'        => $where['id_detalle']
                    ,'id_usuario'       => $where['id_usuario']
                    ,'id_empresa'       => $where['id_empresa']
                    ,'monto_tipo_pago'  => $request['monto_tipo_pago'][$i]
                ];
                CatSolicitudMonto::where($condicion)->update($data);
         }
        $consulta = json_to_object(CatSolicitudMonto::montos_by_id($where));
        #debuger($consulta);
        if ( $consulta->success == true ) {
            return json_encode(['success' => true, 'result' => $consulta->result ]);
        }
        return json_encode( ['success' => false , 'result' => [] ] );

    }




}
