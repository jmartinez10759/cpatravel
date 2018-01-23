<?php

namespace App\Http\Controllers\Apirest;

use Illuminate\Http\Request;
use App\Model\Apirest\TblPolitica;
#use App\Http\Controllers\Controller;
use App\Http\Controllers\Apirest\MasterController;

class PoliticaController extends MasterController
{
    private $_id = "id_politica";

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
                $data = TblPolitica::all();

                if (count($data) > 0) {

                    foreach ($data as $response) {
                        $result[] = [
                                'id_politica'                   => $response->id_politica
                                ,'importe_ded_nal'              => $response->importe_ded_nal
                                ,'importe_ded_ext'              => $response->importe_ded_ext
                                ,'importe_emp_nal'              => $response->importe_emp_nal
                                ,'importe_emp_ext'              => $response->importe_emp_ext
                                ,'status'                       => $response->status
                                ,'id_usuario'                   => $response->id_usuario
                                ,'id_empresa'                   => $response->id_empresa
                                ,'id_proyecto'                  => $response->id_proyecto
                                ,'id_subproyecto'               => $response->id_subproyecto
                                ,'id_viaje'                     => $response->id_viaje
                                ,'tipo'                         => $response->tipo
                                ,'id_etiqueta'                  => $response->id_etiqueta

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
          $response = json_decode( json_encode($request->data) );
        #se insertan los datos 
            TblPolitica::create([
                    'importe_ded_nal'              => $response->importe_ded_nal
                    ,'importe_ded_ext'              => $response->importe_ded_ext
                    ,'importe_emp_nal'              => $response->importe_emp_nal
                    ,'importe_emp_ext'              => $response->importe_emp_ext
                    ,'status'                       => $response->status
                    ,'id_usuario'                   => $response->id_usuario
                    ,'id_empresa'                   => $response->id_empresa
                    ,'id_proyecto'                  => $response->id_proyecto
                    ,'id_subproyecto'               => $response->id_subproyecto
                    ,'id_viaje'                     => $response->id_viaje
                    ,'tipo'                         => $response->tipo
                    ,'id_etiqueta'                  => $response->id_etiqueta
                ]);
                $result = [];
                $data = TblPolitica::latest()->limit(1)->get();
                if (count($data) > 0) {
                    foreach ($data as $response) {
                        $result[] = [
                                'id_politica'                   => $response->id_politica
                                ,'importe_ded_nal'              => $response->importe_ded_nal
                                ,'importe_ded_ext'              => $response->importe_ded_ext
                                ,'importe_emp_nal'              => $response->importe_emp_nal
                                ,'importe_emp_ext'              => $response->importe_emp_ext
                                ,'status'                       => $response->status
                                ,'id_usuario'                   => $response->id_usuario
                                ,'id_empresa'                   => $response->id_empresa
                                ,'id_proyecto'                  => $response->id_proyecto
                                ,'id_subproyecto'               => $response->id_subproyecto
                                ,'id_viaje'                     => $response->id_viaje
                                ,'tipo'                         => $response->tipo
                                ,'id_etiqueta'                  => $response->id_etiqueta

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
    public function show( $data = array() )
    {  
        $datos = self::parse_register($data,new TblPolitica);
        if( isset($datos['success']) && $datos['success'] == false ){
            return $this->show_error(3,$datos['result']);
        }
       #se hace la cosulta realizada por identifocado
        $response = TblPolitica::where($datos)->get();
        $result = [];
        if (count($response) > 0) {
            foreach ($response as $response) {
                $result[] =[
                    'id_politica'                   => $response->id_politica
                    ,'importe_ded_nal'              => $response->importe_ded_nal
                    ,'importe_ded_ext'              => $response->importe_ded_ext
                    ,'importe_emp_nal'              => $response->importe_emp_nal
                    ,'importe_emp_ext'              => $response->importe_emp_ext
                    ,'status'                       => $response->status
                    ,'id_usuario'                   => $response->id_usuario
                    ,'id_empresa'                   => $response->id_empresa
                    ,'id_proyecto'                  => $response->id_proyecto
                    ,'id_subproyecto'               => $response->id_subproyecto
                    ,'id_viaje'                     => $response->id_viaje
                    ,'tipo'                         => $response->tipo
                    ,'id_etiqueta'                  => $response->id_etiqueta
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
            $data = TblPolitica::where($where)
                                ->update($request);
        #se realiza una cosulta del dato que se actualizo.
            $consulta = TblPolitica::where($where)->get();
             $result = [];
            if (count($consulta) > 0) {
                foreach ($consulta as $response) {
                    $result[] =[
                        'id_politica'                   => $response->id_politica
                        ,'importe_ded_nal'              => $response->importe_ded_nal
                        ,'importe_ded_ext'              => $response->importe_ded_ext
                        ,'importe_emp_nal'              => $response->importe_emp_nal
                        ,'importe_emp_ext'              => $response->importe_emp_ext
                        ,'status'                       => $response->status
                        ,'id_usuario'                   => $response->id_usuario
                        ,'id_empresa'                   => $response->id_empresa
                        ,'id_proyecto'                  => $response->id_proyecto
                        ,'id_subproyecto'               => $response->id_subproyecto
                        ,'id_viaje'                     => $response->id_viaje
                        ,'tipo'                         => $response->tipo
                        ,'id_etiqueta'                  => $response->id_etiqueta
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
            $update = ['status' => 0 ];
            $data = TblPolitica::where($where)
                                ->update($update);
        #se realiza una cosulta del dato que se actualizo.
            $result = [];
            $consulta = TblPolitica::where($where)->get();
            if (count($consulta) > 0) {
                foreach ($consulta as $response) {
                    
                    $result[] =[
                        'id_politica'                   => $response->id_politica
                        ,'importe_ded_nal'              => $response->importe_ded_nal
                        ,'importe_ded_ext'              => $response->importe_ded_ext
                        ,'importe_emp_nal'              => $response->importe_emp_nal
                        ,'importe_emp_ext'              => $response->importe_emp_ext
                        ,'status'                       => $response->status
                        ,'id_usuario'                   => $response->id_usuario
                        ,'id_empresa'                   => $response->id_empresa
                        ,'id_proyecto'                  => $response->id_proyecto
                        ,'id_subproyecto'               => $response->id_subproyecto
                        ,'id_viaje'                     => $response->id_viaje
                        ,'tipo'                         => $response->tipo
                        ,'id_etiqueta'                  => $response->id_etiqueta
                    ];

                }
                return $this->_message_success(202,$result);
            }
        }   

        return $this->show_error(3);
    }

}
