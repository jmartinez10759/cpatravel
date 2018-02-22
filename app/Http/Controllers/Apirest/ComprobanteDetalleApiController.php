<?php

namespace App\Http\Controllers\Apirest;

use App\Model\MasterModel;
use Illuminate\Http\Request;
use App\Model\Apirest\TblEtiqueta;
use App\Model\Apirest\ComprobanteDetalleApiModel;
use App\Model\Apirest\ComprobanteEtiquetaApiModel;
use App\Http\Controllers\Apirest\MasterController;

class ComprobanteDetalleApiController extends MasterController
{
    
    private $_id = "id_comprobante_detalle";
    private $_model;
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request ){
        #se manda a llamar el metodo para hacer la validacion de los permisos.
        $this->_model = new ComprobanteDetalleApiModel;
        return self::validate_permisson($this->_id,[],$request);
    
    }
    /**
     *Metodo para obtener todos los registros de los proyectos
     *@access public 
     *@return json
     */
    public function all(){   
    	
        $response = MasterModel::show_model( [], [], $this->_model );
        $result = [];
        $i=0;
        $id_etiqueta = [];
        if ( count($response) > 0 ) {

            foreach ($response as $key => $values) {

                foreach ($values as $key => $value) {
                    $result[$i][$key] = $value;
                }
                $result[$i]['etiquetas'] = self::etiquetas($values) ;
                $i++;
            }
            return $this->_message_success(200,$result);
        }

        return $this->show_error(4);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( $request ){

        if ( isset($request->data) ) {

            $response = MasterModel::insert_model( $request->data, $this->_model );
            $insert = [];

            if ( sizeof( $response) > 0 ) {

                for ($i=0; $i < count( $request->data ); $i++) { 
                    foreach ($request->data[$i]['etiquetas'] as $key => $value) {
                        $insert[] = [
                            'id_comprobante'            => $response[$i]->id_comprobante
                            ,'id_comprobante_detalle'   => $response[$i]->id_comprobante_detalle
                            ,'id_etiqueta'              => MasterModel::show_model(['id_etiqueta'],['etiqueta_nombre' => $value], new TblEtiqueta)[0]->id_etiqueta
                        ];
                    }
                }
                $responses = MasterModel::insert_model( $insert , new ComprobanteEtiquetaApiModel);
                $resultados = [];
                if ( sizeof( $responses ) > 0 ) {
                    for ($i=0; $i < count($response); $i++) { 
                        foreach ($response[$i] as $key => $value) {
                            $resultados[$i][$key] = $value;
                        }
                            $resultados[$i]['etiquetas'] = $request->data[$i]['etiquetas'];
                    }
                }
                return $this->_message_success( 201,$resultados );
            }

        }
        return $this->show_error(5);

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $data = array() )
    {  
        $where = self::parse_register([$data], $this->_model);
        if( isset($where['success']) && $where['success'] == false ){
            return $this->show_error(3,$where['result']);
        }

        $response = MasterModel::show_model( [], $where, $this->_model );
        $responses = MasterModel::show_model( [], $where, new ComprobanteEtiquetaApiModel );
        if ( count($response) > 0 ) {
            
            $result = [];
            foreach ($response as $key => $values) {
                
                foreach ($values as $key => $value) {
                    $result[$key] = $value;
                }
            }

            foreach ($responses as $key => $values) {
                foreach ($values as $key => $value) {
                    
                    if ( $key == "id_etiqueta" ) {
                        $where = [$key => $value];
                        $result['etiquetas'][] = MasterModel::show_model(['etiqueta_nombre'],$where, new TblEtiqueta)[0]->etiqueta_nombre;
                    }

                }
            }
            return $this->_message_success(200,$result);
        }

        return $this->show_error(4);
    
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( $request, $id ){
        
        if( !empty( $id ) ){
            $where = [ $this->_id => $id ];
            $result = [];
            foreach ($request as $key => $value) {
                if ( $key != "etiquetas" ) {
                    $result[$key] = $value;
                }

            }
            $insert = [];
            for ($i=0; $i < count($request['etiquetas']); $i++) {
                $wheres = ['etiqueta_nombre' => $request['etiquetas'][$i]];
                $id_etiqueta = ( MasterModel::show_model(['id_etiqueta'],$wheres, new TblEtiqueta) != null )?MasterModel::show_model(['id_etiqueta'],$wheres, new TblEtiqueta)[0]->id_etiqueta : false; 
                if (!$id_etiqueta) {
                    return $this->show_error(3,$request['etiquetas'][$i]);
                }
                $insert[] = [
                            'id_comprobante'            => $result['id_comprobante']
                            ,'id_comprobante_detalle'   => $result['id_comprobante_detalle']
                            ,'id_etiqueta'              => $id_etiqueta
                        ];
                
            }

            $response = MasterModel::update_model( $where, $result, $this->_model );
            if ( count($response) > 0 ) {

                $responses = MasterModel::insert_model( $insert , new ComprobanteEtiquetaApiModel);
                $etiquetas = [];
                foreach ($responses as $key => $values) {
                    foreach ($values as $key => $value) {
                        if( $key == "id_etiqueta" ){
                            $where = [ $key => $value ];
                            $etiquetas[] = MasterModel::show_model(['etiqueta_nombre'], $where, new TblEtiqueta)[0]->etiqueta_nombre; 
                        }
                    }
                }

                $resultados = [];
                if ( sizeof( $responses ) > 0 ) {
                    for ($i=0; $i < count($response); $i++) { 
                        foreach ($response[$i] as $key => $value) {
                            $resultados[$i][$key] = $value;
                        }
                            $resultados[$i]['etiquetas'] = $etiquetas;
                    }
                    return $this->_message_success(202,$resultados);
                }            
            }

        }   
        return $this->show_error(3);
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id ){
        
        if( !empty( $id ) ){

            $where = [ $this->_id => $id ];
            $response = MasterModel::delete_model( $where, $this->_model );
            $responses = MasterModel::delete_model( $where, new ComprobanteEtiquetaApiModel );
            if ( count($response) == 0 && count($responses) == 0 ) {
                return $this->_message_success(202,$response);
            }
            
        }   

        return $this->show_error(3);
    
    }
    /**
     *Metodo para la iteracion de las etiquetas
     *@access public
     *@param array $response [descripcion]
     *@return array [descripcion]
     */
    public function etiquetas( $response = array() ){

        foreach ($response as $key => $value) {
            if ( $key == "id_comprobante" || $key == "id_comprobante_detalle" ) {
                $where[$key] = $value;
            }
        }
        $result = isset(MasterModel::show_model(['id_etiqueta'],$where,new ComprobanteEtiquetaApiModel)[0]->id_etiqueta)? MasterModel::show_model(['id_etiqueta'],$where,new ComprobanteEtiquetaApiModel) : [];
        $etiquetas = [];
        if ( count( $result ) > 0 ) {
            foreach ($result as $key => $values) {
                foreach ($values as $key => $value) {
                    $where = [$key => $value];
                }
                $etiquetas[] = MasterModel::show_model(['etiqueta_nombre'],$where,new TblEtiqueta)[0]->etiqueta_nombre;
            }
        }
        return $etiquetas;
    }
    



}
