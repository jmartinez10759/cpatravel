<?php

namespace App\Http\Controllers\Web;

use Session;
use App\Label;
use App\Country;
use App\StatusAccount;
use Illuminate\Http\Request;
use App\ModelWeb\CatViaticoDetalle;
use App\Model\Apirest\TblEtiqueta;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\Web\MasterWebController;
use App\Http\Controllers\Web\MontoSolicitudController;

class ViaticoDetalleWebController extends MasterWebController
{
    #private $_permits;
    
    public function __construct(){
        parent::__construct();
        $this->session_expire();
        #$this->_permits=  self::verify_permison();
    }
    /**
     *Metodo que se encarga de visualizar la vista principal de cada viatico 
     *@access public 
     *@param Request $request [description]
     *@return void
     */
    public function main( Request $request ){

    	#if ($this->_permits) { return $this->_permits; }
        #se valida que tenga datos la id_solicitud
        $viaticos = null;
        if ( !empty($request->id_solicitud) ) {
            #se realiza una consulta de los viaticos para mostrarlos en el grid
            $viaticos = json_to_object( self::consulta_group( $request ) );
        }
        #debuger($viaticos);
        #se manda a llamar una metodo para mandar a llamar los viaticos disponibles
    	/*$url = "http://".$this->_domain."/api/travel/etiquetas?id_etiqueta=".$request->id_viatico."&id_usuario=".$_SERVER['HTTP_USUARIO'];
         $headers = [ 
            'Content-Type'  => 'application/json'
            ,'usuario'      => $_SERVER['HTTP_USUARIO']
            ,'token'        => $_SERVER['HTTP_TOKEN']
          ];
        $method = "get";
        $response = self::endpoint( $url,$headers,[],$method );*/
        $where = [
            'id_etiqueta' => $request->id_viatico
            ,'id_empresa' => Session::get('business_id')
        ];
        $response = json_to_object(TblEtiqueta::consulta_etiqueta($where));
        $etiquetas = [];
        if ($response->success == true) {
            $etiquetas = $response->result[0];
        }
        #debuger($etiquetas);
        $respuesta = [ 
            #'etiquetas' => ( isset($response->result) )? $response->result[0] : [ 'etiquetas' => [] ]
            'etiquetas' => $etiquetas
            ,'viaticos' => $viaticos 
            ,'success'  => true
            ,'message' => "Transaccion Exitosa"
        ];
        #debuger($respuesta);
        return json_encode( $respuesta );

    }
    /**
     *Metodo para hacer una consulta agrupada por id_viatico
     *@access public
     *@param object [description]
     *@return void
     */
    public function consulta_group( $request ){

        //se hace la conulta de los viaticos agrupados por su id_viatico
        $where = [
            'id_viatico'    => $request->id_viatico
            ,'id_solicitud' => $request->id_solicitud
            ,'id_usuario'   => $_SERVER['HTTP_USUARIO']
            ,'id_empresa'   => Session::get('business_id')
        ];

        $response = json_to_object( CatViaticoDetalle::consulta_group( $where ) );
        #debuger($response);
        $result=[];
        if ( count($response) > 0 ) {
        
            foreach ($response as $response) {
               
               $result[]=[

                     'id_detalle'               => $response->id_detalle
                    ,'id_solicitud'             => $response->id_solicitud
                    ,'id_viatico'               => $response->id_viatico
                    ,'viatico_nombre'           => $response->etiqueta_nombre
                    ,'viatico_cantidad'         => $response->viatico_cantidad
                    ,'viatico_unidad'           => $response->viatico_unidad
                    ,'viatico_costo_unitario'   => $response->viatico_costo_unitario
                    
               ];

            }
            
            return json_encode( $result );
        }
        
        return json_encode( $result );

    }   
    /**
     *Metodo para la creacion de los registros de los viaticos
     *@access public 
     *@param Request $request [Description]
     *@return json
     */
    public function guardar( Request $request ){
        #debuger( $request->all() );
        //se realiza la inserccion de los datos de viaticos y montos.
        $datos = [
            'id_solicitud'                  => $request->id_solicitud
            ,'id_viatico'                   => $request->id_viatico   
            ,'id_usuario'                   => $_SERVER['HTTP_USUARIO']
            ,'id_empresa'                   => Session::get('business_id')
            ,'viatico_cantidad'             => $request->viatico_cantidad
            ,'viatico_unidad'               => $request->viatico_unidad
            ,'viatico_costo_unitario'       => $request->viatico_costo_unitario
        ];
        CatViaticoDetalle::create( $datos );
        //se manada a llamar el ultimo registro de la operacion.
        #se obtiene el ultimo registro de la inserccion de la solicitud
            $where = ['created_at' => date("Y-m-d H:i:s") ];
            $data = CatViaticoDetalle::where( $where )->get();
            $result = [];
            if ( count($data) > 0 ) {

                foreach ($data as $response) {
                    $result = [
                            'id_solicitud'                    => $response->id_solicitud
                            ,'id_viatico'                     => $response->id_viatico
                            ,'id_usuario'                     => $response->id_usuario
                            ,'id_empresa'                     => $response->id_empresa
                            ,'viatico_cantidad'               => $response->viatico_cantidad
                            ,'viatico_unidad'                 => $response->viatico_unidad
                            ,'viatico_costo_unitario'         => $response->viatico_costo_unitario
                            ,'status'                         => $response->status
                        ]; 
                }
                //se manda a llamar un metodo donde se encarga de insertar los montos en formago se convierte en json 
                $respuesta = json_to_object( MontoSolicitudController::guardar( $request ) );
                if ( $respuesta->success == true ) {

                    return json_encode( ['success' => true, 'result' => $respuesta->result,'message' => "Transaccion Exitosa" ] );

                }

            }else{
                
                return json_encode(['success' => false, 'result' => []]);

            }

    }
    /**
     *Metodo para la consulta de un solo viatico agregado y mostrar sus registros
     *@access public 
     *@param Request $request [Description]
     *@return json
     */
    public function detalles( Request $request ){

        //se hace la conulta de los viaticos para obtener sus detalles
        $where = [
            'id_detalle'     => $request->id_detalle
            ,'id_empresa'    => Session::get('business_id')
            ,'id_usuario'    => $_SERVER['HTTP_USUARIO']
        ];
        $response = json_to_object(CatViaticoDetalle::viaticos_by_id( $where ));
        #debuger($response->result);
        $result=[];
        if ( $response->success == true ) {
        
            foreach ($response->result as $response) {
               
               $result =[

                     'id_detalle'               => $response->id_detalle
                    ,'id_solicitud'             => $response->id_solicitud
                    ,'id_viatico'               => $response->id_viatico
                    ,'viatico_cantidad'         => $response->viatico_cantidad
                    ,'viatico_unidad'           => $response->viatico_unidad
                    ,'viatico_costo_unitario'   => $response->viatico_costo_unitario
                    
               ];

            }
            #se manda a llamar los montos correspondientes a ese viatico de detalle
            $respuesta = json_to_object( MontoSolicitudController::detalles( array_to_object($result) ) );
            #debuger($respuesta->result);
            if ( $respuesta->success == true ) {
                    //return json_encode( ['success' => true, 'result' => $respuesta->result ] );
                    return json_encode( ['success' => true, 'result_viaticos' => $result, 'result_montos' => $respuesta->result ,'message' => "Transaccion Exitosa" ] );

                }
        }
        
        return json_encode( ['success' => false, 'result' => $result ] );


    }
    /**
     *Metodo para la borrar los montos y viaticos disponibles
     *@access public 
     *@param Request $request [Description]
     *@return json
     */
    public function borrar( Request $request ){

        $where = [
            'id_detalle' => $request->id_detalle
        ];
        #debuger($where);
        #se manda a llamar Eloquent para borrar los registros
        $montos = json_to_object(MontoSolicitudController::borrar( $where ));

        if( $montos->success == true ){
            $viaticos = CatViaticoDetalle::where( $where )->delete();
            return json_encode(['success' => true ,'message' => "Transaccion Exitosa"]);

        }

        return json_encode(['success' => false]);


    }
    /**
     *Metodo para actualizar los registros de los montos
     *@access public 
     *@param Request $request [Description]
     *@return json
     */
    public function actualizar ( Request $request ){
        #debuger($request->all());
        if ( !empty($request->id_detalle) ) {
                
            $where = [
                'id_detalle' => $request->id_detalle
                ,'id_usuario' => $_SERVER['HTTP_USUARIO']
                ,'id_empresa' => Session::get('business_id')
            ];

            $viaticos_register = [

                    'id_viatico'                 => $request->id_viatico
                    ,'viatico_cantidad'          => $request->viatico_cantidad
                    ,'viatico_unidad'            => $request->viatico_unidad
                    ,'viatico_costo_unitario'    => $request->viatico_costo_unitario   
            ];
            $response = json_to_object( CatViaticoDetalle::actualizar( $where,$viaticos_register ) );
            if ($response->success == true) {
                
                $montos_register = [

                    'monto_tipo_solicitud'          => $request->monto_tipo_solicitud
                    ,'monto_tipo_pago'              => $request->monto_tipo_pago
                    ,'monto_importe'                => $request->monto_importe
                    ,'monto_importe_autorizado'     =>  $request->monto_importe_autorizado

                ];
                $montos = json_to_object( MontoSolicitudController::actualizar( $where ,$montos_register ) );
                if ( $montos->success == true ) {
                    return json_encode( ['success' => true, 'result' => $response->result ,'message' => 'Accion Realizada' ] );
                    
                }else{
                    return json_encode([ 'success' => false,'message' => "Ocurrio un error" ]);
                }

            }else{

                return json_encode([ 'success' => false,'message' => "Ocurrio un error" ]);
            }
        
        }
        return json_encode([ 'success' => false , 'message' => "No contine identificador"]);

    }


}
