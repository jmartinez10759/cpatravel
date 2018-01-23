<?php

namespace App\Http\Controllers\Apirest;

use Illuminate\Http\Request;
#use App\Http\Controllers\Controller;
use App\RelUsuarioProyecto;
use App\Http\Controllers\Apirest\MasterController;
use App\Http\Controllers\Apirest\ValidateTokenController;
use App\Http\Controllers\Apirest\ValidatePermissonController;

class RelUsuarioProyectoController extends MasterController
{
 
    private $_id = "id_usuario";
    private $_token;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( $params=false,$id=false,$params2=false,$id2=false,$params3=false,$id3=false ,Request $request ){
        $parametros = [
            $params  => $id,
            $params2 => $id2,
            $params3 => $id3
        ];
        #se manda a llamar el metodo para hacer la validacion de los permisos.
        return self::validate_permisson($this->_id,$parametros,$request);
    }
    /**
     *Metodo para obtener todos los registros de los proyectos
     *@access public 
     *@param $data array [description]
     *@return json
     */
    public function all(){        
             #se realiza la consulta regresando los valores en formato json
                $datos = [];
                $data = RelUsuarioProyecto::all();

                if (count($data) > 0) {

                    foreach ($data as $project) {
                        $datos[] = [
                                'id_usuario'      => $project->id_usuario,
                                'id_proyecto'     => $project->id_proyecto,
                                'id_subproyecto'  => $project->id_subproyecto,
                                'id_viaje'        => $project->id_viaje
                            ]; 
                    }
                    return $this->_message_success(200,$datos);
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
          $datos = json_decode( json_encode($request->data) );
        #se insertan los datos 
            RelUsuarioProyecto::create([
                    'id_usuario'        => $datos->id_usuario
                    ,'id_proyecto'      => $datos->id_proyecto
                    ,'id_subproyecto'   => $datos->id_subproyecto
                    ,'id_viaje'         => $datos->id_viaje
                ]);
            #se realiza una consulta si se insertan correctamente
            $data = RelUsuarioProyecto::all();
            $dato = [];
                if (count($data) > 0) {

                    foreach ($data as $project) {
                        $dato[] = [
                                'id_usuario'      => $project->id_usuario,
                                'id_proyecto'     => $project->id_proyecto,
                                'id_subproyecto'  => $project->id_subproyecto,
                                'id_viaje'        => $project->id_viaje
                            ]; 
                    }
                    return $this->_message_success(200,$dato);
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
        $datos = [];
        foreach ($data as $key => $value) {
            if ($value != false) {
                $datos[$key] = $value;
            }
        }
       #se hace la cosulta realizada por identifocado
        $consulta = RelUsuarioProyecto::where($datos)->get();
        $result = [];
        if (count($consulta) > 0) {
            foreach ($consulta as $consulta) {
                $result [] =[
                     'id_usuario'      => $consulta->id_usuario,
                     'id_proyecto'     => $consulta->id_proyecto,
                     'id_subproyecto'  => $consulta->id_subproyecto,
                     'id_viaje'        => $consulta->id_viaje
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
            $empresa = (isset( $request["empresa"] ) ) ? ['id_empresa' => $request["empresa"] ] : [];
            $nombre = (isset( $request["nombre"] ) ) ? ['nombre' => $request["nombre"] ] : [];
            $proyecto  = (isset( $request["proyecto"] ) ) ? ['proyecto' => $request["proyecto"] ] : [];
            #dd(array_merge($empresa,$nombre,$proyecto));
            $data = RelUsuarioProyecto::where($this->_id,"=",$id)
                                ->update(array_merge($empresa,$nombre,$proyecto));
        #se realiza una cosulta del dato que se actualizo.
            $consulta = RelUsuarioProyecto::where($this->_id,"=",$id)->get();
            $result = [];
            if (count($consulta) > 0) {
                foreach ($consulta as $consulta) {
                    $result [] =[
                        'id_usuario'      => $consulta->id_usuario,
                        'id_proyecto'     => $consulta->id_proyecto,
                        'id_subproyecto'  => $consulta->id_subproyecto,
                        'id_viaje'        => $consulta->id_viaje
                    ]; 
                }
                return $this->_message_success(200,$result);
            }
            #return response()->json(["success" => true , "msg" => "Se actualizo correctamente el registro"]);
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
            #dd(array_merge($nombre,$proyecto));
            $data = RelUsuarioProyectoController::where($this->_id,"=",$id)
                                ->update(['status' => 0 ]);
        #se realiza una cosulta del dato que se actualizo.
            $identificador = RelUsuarioProyectoController::where($this->_id,"=",$id)->get();
            if (count($identificador) > 0) {
                return response()->json($identificador);
            }
            #return response()->json(["success" => true , "msg" => "Se actualizo correctamente el registro"]);
        }   
        return response()->json(["success" => false, "msg" => "Es necesario ingresar el Id"]);
    }
   
}
