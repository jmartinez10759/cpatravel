<?php

namespace App\Http\Controllers\Apirest;

use Illuminate\Http\Request;
use App\Model\Apirest\TblEtiqueta;
use App\Http\Controllers\Apirest\MasterController;

class EtiquetaController extends MasterController
{
    private $_id = "id_etiqueta";

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request ){
        #se manda a llamar el metodo para hacer la validacion de los permisos.
        return self::validate_permisson($this->_id,[],$request);
    
    }
    /**
     *Metodo para obtener todos los registros de los proyectos
     *@access public 
     *@param $data array [description]
     *@return json
     */
    public function all(){        
         #se realiza la consulta regresando los valores en formato json
            $result = [];
            $data = TblEtiqueta::all();

            if (count($data) > 0) {

                foreach ($data as $response) {
                    $result[] = [
                            'id_etiqueta'                    => $response->id_etiqueta
                            ,'id_usuario'                    => $response->id_usuario
                            ,'id_empresa'                    => $response->id_empresa
                            ,'etiqueta_img'                  => $response->etiqueta_img
                            ,'etiqueta_nombre'               => $response->etiqueta_nombre
                            ,'etiqueta_descripcion'          => $response->etiqueta_descripcion
                            ,'etiqueta_tipo'                 => $response->etiqueta_tipo
                            ,'etiqueta_tipo_img'             => $response->etiqueta_tipo_img

                        ]; 
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

        if (isset($request->data)) {

            #$response = json_decode( json_encode($request->data) );
            $response = array_to_object( $request->data );
            #se insertan los datos 
            TblEtiqueta::create([
                    'id_usuario'                    => $response->id_usuario
                    ,'id_empresa'                    => $response->id_empresa
                    ,'etiqueta_img'                  => $response->etiqueta_img
                    ,'etiqueta_nombre'               => $response->etiqueta_nombre
                    ,'etiqueta_descripcion'          => $response->etiqueta_descripcion
                    ,'etiqueta_tipo'                 => $response->etiqueta_tipo
                    ,'etiqueta_tipo_img'             => $response->etiqueta_tipo_img
                ]);
                $result = [];
                #$data = TblEtiqueta::latest()->limit(1)->get();
                #se obtiene el ultimo registro de la inserccion de la solicitud
                $where = ['created_at' => date("Y-m-d H:i:s") ];
                $data = TblEtiqueta::where( $where )->get();
                if (count($data) > 0) {
                    foreach ($data as $response) {
                        $result[] = [
                                'id_etiqueta'                   => $response->id_etiqueta
                                ,'id_usuario'                    => $response->id_usuario
                                ,'id_empresa'                    => $response->id_empresa
                                ,'etiqueta_img'                  => $response->etiqueta_img
                                ,'etiqueta_nombre'               => $response->etiqueta_nombre
                                ,'etiqueta_descripcion'          => $response->etiqueta_descripcion
                                ,'etiqueta_tipo'                 => $response->etiqueta_tipo
                                ,'etiqueta_tipo_img'             => $response->etiqueta_tipo_img
                            ]; 
                    }
                    return $this->_message_success(201,$result);
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
    public function show( $data = array() ){  
        $datos = self::parse_register($data,new TblEtiqueta);
        if( isset($datos['success']) && $datos['success'] == false ){
            return $this->show_error(3,$datos['result']);
        }
       #se hace la cosulta realizada por identifocado
        $response = TblEtiqueta::where($datos)->get();
        $result = [];
        if (count($response) > 0) {
            foreach ($response as $response) {
                $result[] =[
                     'id_etiqueta'                    => $response->id_etiqueta
                    ,'id_usuario'                    => $response->id_usuario
                    ,'id_empresa'                    => $response->id_empresa
                    ,'etiqueta_img'                  => $response->etiqueta_img
                    ,'etiqueta_nombre'               => $response->etiqueta_nombre
                    ,'etiqueta_descripcion'          => $response->etiqueta_descripcion
                    ,'etiqueta_tipo'                 => $response->etiqueta_tipo
                    ,'etiqueta_tipo_img'             => $response->etiqueta_tipo_img
                ]; 
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
    public function update( $request, $id){
        
        if( !empty( $id ) ){
            $where = [$this->_id => $id];
            $data = TblEtiqueta::where($where)
                                ->update($request);
        #se realiza una cosulta del dato que se actualizo.
            $consulta = TblEtiqueta::where($where)->get();
             $result = [];
            if (count($consulta) > 0) {
                foreach ($consulta as $response) {
                    $result[] =[
                          'id_etiqueta'                   => $response->id_etiqueta
                        ,'id_usuario'                    => $response->id_usuario
                        ,'id_empresa'                    => $response->id_empresa
                        ,'etiqueta_img'                  => $response->etiqueta_img
                        ,'etiqueta_nombre'               => $response->etiqueta_nombre
                        ,'etiqueta_descripcion'          => $response->etiqueta_descripcion
                        ,'etiqueta_tipo'                 => $response->etiqueta_tipo
                        ,'etiqueta_tipo_img'             => $response->etiqueta_tipo_img
                    ]; 
                }
                return $this->_message_success(202,$result);
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
    public function destroy($id){
        
        if( !empty( $id ) ){
                $where = [$this->_id => $id];
                $data = TblEtiqueta::where($where)
                                    ->update(['status' => 0 ]);
            #se realiza una cosulta del dato que se actualizo.
                $result = [];
                $consulta = TblEtiqueta::where($where)->get();
                if (count($consulta) > 0) {
                    foreach ($consulta as $response) {
                        
                        $result[] =[
                             'id_etiqueta'                   => $response->id_etiqueta
                            ,'id_usuario'                    => $response->id_usuario
                            ,'id_empresa'                    => $response->id_empresa
                            ,'etiqueta_img'                  => $response->etiqueta_img
                            ,'etiqueta_nombre'               => $response->etiqueta_nombre
                            ,'etiqueta_descripcion'          => $response->etiqueta_descripcion
                            ,'etiqueta_tipo'                 => $response->etiqueta_tipo
                            ,'etiqueta_tipo_img'             => $response->etiqueta_tipo_img
                        ];

                    }
                    return $this->_message_success(202,$result);
                }
        }   
        return $this->show_error(3);

    }

}
