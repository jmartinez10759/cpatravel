<?php

namespace App\Http\Controllers\Apirest;

use App\Model\MasterModel;
use Illuminate\Http\Request;
#use App\Http\Controllers\Controller;
use App\Model\Apirest\ComprobanteApiModel;
use App\Http\Controllers\Apirest\MasterController;

class ComprobanteApiController extends MasterController
{
    
    private $_id = "id_comprobante";
    private $_fechas = ['fecha_emision'];
    private $_model;
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request ){
        #se manda a llamar el metodo para hacer la validacion de los permisos.
        $this->_model = new ComprobanteApiModel;
        return self::validate_permisson($this->_id,[],$request);
    }
    /**
     *Metodo para obtener todos los registros de los proyectos
     *@access public 
     *@return json
     */
    public function all(){

        $response = MasterModel::show_model([],[], $this->_model );        
        if ( sizeof($response) > 0 ) {
            return $this->_message_success(200,$response);
        }
        return $this->show_error(4); 

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( $request ){

        if (isset($request->data)) {

            $datos = self::parse_register([$request->data], $this->_model );
            if( isset($datos['success']) && $datos['success'] == false ){
                return self::show_error(3,$datos['result']);
            }

            $response = MasterModel::insert_model( [$request->data] , $this->_model );
            if ( sizeof( $response ) > 0 ) {
                return $this->_message_success(201,$response);
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
        $datos = self::parse_register([$data], $this->_model );
        if( isset($datos['success']) && $datos['success'] == false ){
            return self::show_error(3,$datos['result']);
        }        
        $response = MasterModel::show_model([],$datos, $this->_model );
        if ( sizeof( $response ) > 0) {
            return $this->_message_success(200,$response);
        }
        return self::show_error(4);

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( $request, $id){
        
        if( !empty( $id ) ){

            $where = [$this->_id => $id];
            $response = MasterModel::update_model($where, $request, $this->_model );
            if ( count($response) > 0) {
                return $this->_message_success(202,$response);
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
    public function destroy($id)
    {
        
        if( !empty( $id ) ){

            $where = [$this->_id => $id];
            $update = ['status' => 0 ];
            $response = MasterModel::update_model( $where, $update, $this->_model );
            if ( sizeof( $response) > 0) {
                return $this->_message_success(202,$response);
            }

        }   

        return $this->show_error(3);
    
    }


}
