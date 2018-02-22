<?php

namespace App\Http\Controllers\Apirest;

use App\TblViaje;
use App\TblProyecto;
use App\TblSubProyecto;
use App\Model\MasterModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Apirest\TblEtiqueta;
use App\ModelWeb\CatViaticoDetalle;
use App\ModelWeb\CatSolicitudMonto;
use App\Model\Apirest\TblSolicitud;
use App\ModelWeb\CatSolicitudCompanion;
use App\Http\Controllers\Apirest\MasterController;

class SolicitudController extends MasterController
{
    
    private $_id = "id_solicitud";
    private $_fechas = ['solicitud_fecha_inicio','solicitud_fecha_fin'];
    private $_model;

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request ){
        #se manda a llamar el metodo para hacer la validacion de los permisos.
        $this->_model = new TblSolicitud;
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
            $data = MasterModel::show_model( [], [], $this->_model );

            if (count($data) > 0) {

                foreach ($data as $response) {
                    $result[] = [
                            'id_solicitud'                    => $response->id_solicitud
                            ,'id_proyecto'                    => $response->id_proyecto
                            ,'proyecto'                       => MasterModel::show_model(['nombre'],['id_proyecto' => $response->id_proyecto],new TblProyecto)[0]->nombre
                            ,'id_subproyecto'                 => $response->id_subproyecto
                            ,'subproyecto'                    => MasterModel::show_model( ['nombre'],['id_subproyecto' => $response->id_subproyecto],new TblSubProyecto)[0]->nombre
                            ,'id_viaje'                       => $response->id_viaje
                            ,'viaje'                          => MasterModel::show_model(['nombre'],['id_viaje' => $response->id_viaje],new TblViaje)[0]->nombre
                            ,'id_usuario'                     => $response->id_usuario
                            ,'id_empresa'                     => $response->id_empresa
                            ,'solicitud_fecha_inicio'         => $response->solicitud_fecha_inicio
                            ,'solicitud_fecha_fin'            => $response->solicitud_fecha_fin
                            ,'solicitud_horario_inicio'       => $response->solicitud_horario_inicio
                            ,'solicitud_horario_fin'          => $response->solicitud_horario_fin
                            ,'solicitud_destino_inicio'       => $response->solicitud_destino_inicio
                            ,'solicitud_destino_final'        => $response->solicitud_destino_final
                            ,'status'                         => $response->estatus
                            ,'total'                          => self::viaticos_detalles($response)['total']
                            ,'viaticos_detalles'              => self::viaticos_detalles($response)['result']
                            ,'acompanantes'                   => self::companion_solicitud($response)
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
          return self::transaccion_insert($response);
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

        $datos = self::parse_register([$data],$this->_model,$this->_fechas);
        if( isset($datos['success']) && $datos['success'] == false ){
            return $this->show_error(3,$datos['result']);
        }
       #se hace la cosulta realizada por identifocado
        $response = MasterModel::show_model( [],$datos,$this->_model );
        $result = [];
        if (count($response) > 0) {
            foreach ($response as $response) {
                $where = [
                  'id_solicitud' => $response->id_solicitud
                  ,'id_empresa' =>  $response->id_empresa
                  ,'id_usuario' =>  $response->id_usuario
                ];
                $result[] =[
                    'id_solicitud'                    => ($response->id_solicitud)
                    ,'id_proyecto'                    => $response->id_proyecto
                    ,'proyecto'                       => MasterModel::show_model(['nombre'],['id_proyecto' => $response->id_proyecto],new TblProyecto)[0]->nombre
                    ,'id_subproyecto'                 => $response->id_subproyecto
                    ,'subproyecto'                    => MasterModel::show_model( ['nombre'],['id_subproyecto' => $response->id_subproyecto],new TblSubProyecto)[0]->nombre
                    ,'id_viaje'                       => $response->id_viaje
                    ,'viaje'                       => MasterModel::show_model(['nombre'],['id_viaje' => $response->id_viaje],new TblViaje)[0]->nombre
                    ,'id_usuario'                     => $response->id_usuario
                    ,'id_empresa'                     => $response->id_empresa
                    ,'solicitud_fecha_inicio'         => $response->solicitud_fecha_inicio
                    ,'solicitud_fecha_fin'            => $response->solicitud_fecha_fin
                    ,'solicitud_horario_inicio'       => $response->solicitud_horario_inicio
                    ,'solicitud_horario_fin'          => $response->solicitud_horario_fin
                    ,'solicitud_destino_inicio'       => $response->solicitud_destino_inicio
                    ,'solicitud_destino_final'        => $response->solicitud_destino_final
                    ,'status'                         => $response->estatus
                    ,'total'                          => self::viaticos_detalles($response)['total']
                    ,'viaticos_detalles'              => self::viaticos_detalles($response)['result']
                    ,'acompanantes'                   => self::companion_solicitud($response)
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
            $response = MasterModel::update_model( $where, $request, $this->_model );
            return $this->_message_success(202,$response);

        /*    $data = TblSolicitud::where($where)->update($request);
        #se realiza una cosulta del dato que se actualizo.
            $consulta = TblSolicitud::where($where)->get();
             $result = [];
            if (count($consulta) > 0) {
                foreach ($consulta as $response) {
                    $result[] =[
                        'id_solicitud'                    => $response->id_solicitud
                        ,'id_proyecto'                    => $response->id_proyecto
                        ,'id_subproyecto'                 => $response->id_subproyecto
                        ,'id_viaje'                 	     => $response->id_viaje
                        ,'id_usuario'               	     => $response->id_usuario
                        ,'id_empresa'          			       => $response->id_empresa
                        ,'solicitud_fecha_inicio'          => $response->solicitud_fecha_inicio
                        ,'solicitud_fecha_fin'            => $response->solicitud_fecha_fin
                        ,'solicitud_horario_inicio'       => $response->solicitud_horario_inicio
                        ,'solicitud_horario_fin'          => $response->solicitud_horario_fin
                        ,'solicitud_destino_inicio'       => $response->solicitud_destino_inicio
                        ,'solicitud_destino_final'        => $response->solicitud_destino_final
                        ,'status'             			      => $response->status
                    ]; 
                }
                return $this->_message_success(202,$result);
            }*/
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
            $data = TblSolicitud::where($where)->update(['status' => 0 ]);
        #se realiza una cosulta del dato que se actualizo.
            $result = [];
            $consulta = TblSolicitud::where($where)->get();
            if (count($consulta) > 0) {
                foreach ($consulta as $response) {
                    
                    $result[] =[
                        'id_solicitud'                    => $response->id_solicitud
                        ,'id_proyecto'                    => $response->id_proyecto
                        ,'id_subproyecto'                 => $response->id_subproyecto
                        ,'id_viaje'                 	  => $response->id_viaje
                        ,'id_usuario'               	  => $response->id_usuario
                        ,'id_empresa'          			  => $response->id_empresa
                        ,'solicitud_fecha_inicio'         => $response->solicitud_fecha_inicio
                        ,'solicitud_fecha_fin'            => $response->solicitud_fecha_fin
                        ,'solicitud_horario_inicio'       => $response->solicitud_horario_inicio
                        ,'solicitud_horario_fin'          => $response->solicitud_horario_fin
                        ,'solicitud_destino_inicio'       => $response->solicitud_destino_inicio
                        ,'solicitud_destino_final'        => $response->solicitud_destino_final
                        ,'status'             			  => $response->status
                    ];

                }
                return $this->_message_success(202,$result);
            }
        }   

        return $this->show_error(3);
   
    }
    /**
     *Metodo para sacar los viaticos por cada solicitud
     *@access public 
     *@param array $data [description]
     *@return void
     */
    public function viaticos_detalles( $data = [] ){

        $where = ['id_solicitud' => $data->id_solicitud, 'id_empresa' => $data->id_empresa, 'id_usuario' => $data->id_usuario];
         #se hace la cosulta realizada por identifocado
        $response = MasterModel::show_model([],$where, new CatViaticoDetalle);
        $result = [];
        $total = 0;
        if (count($response) > 0) {
            foreach ($response as $response) {
                $where = array_merge($where,['id_viatico' => $response->id_viatico , 'id_detalle' => $response->id_detalle]);
                 $params = [
                    'monto_tipo_solicitud' 
                    ,'monto_tipo_pago'
                    ,'monto_importe'
                    ,'monto_importe_autorizado'
                  ];
                #debuger($where);
                $result[] =[

                    'viatico'                       => MasterModel::show_model(['etiqueta_nombre'],['id_etiqueta' => $response->id_viatico],new TblEtiqueta )[0]->etiqueta_nombre
                    ,'viatico_cantidad'             => $response->viatico_cantidad
                    ,'viatico_unidad'               => $response->viatico_unidad
                    ,'viatico_costo_unitario'       => $response->viatico_costo_unitario
                    ,'montos_viaticos'              => ( self::montos_viaticos($response)['result'] )? self::montos_viaticos($response)['result'] :[]
                ]; 
                $total += self::montos_viaticos($response)['total'];
            }

            return ['result' => $result, 'total' => $total ];
            
        }

    }
    /**
     *Metodo para obtener los datos de montos de cada viatico
     *@access public
     *@param array $data [description]
     *@return void
     */
    public function montos_viaticos( $data = array() ){

        $where = [
                  'id_solicitud' => $data->id_solicitud
                  ,'id_empresa' => $data->id_empresa
                  ,'id_usuario' => $data->id_usuario
                  ,'id_viatico' => $data->id_viatico 
                  ,'id_detalle' => $data->id_detalle
            ];
         #se hace la cosulta realizada por identifocado
        $params = [
          'monto_tipo_solicitud' 
          ,'monto_tipo_pago'
          ,'monto_importe'
          ,'monto_importe_autorizado'
        ];
        $response = MasterModel::show_model([],$where,new CatSolicitudMonto);
        #debuger($response);
        $result = [];
        $total = 0;
        if (count($response) > 0) {
            foreach ($response as $response) {
                $result[] =[
                    'monto_tipo_solicitud'                      => $response->monto_tipo_solicitud
                    ,'monto_tipo_pago'                          => $response->monto_tipo_pago
                    ,'monto_importe'                            => $response->monto_importe
                    ,'monto_importe_autorizado'                 => $response->monto_importe_autorizado
                ]; 
                $total += $response->monto_importe;
            }
            return ['result' => $result, 'total' => $total];
        }
    
    }
     /**
      *Metodo para la consulta de 
      *@access public
      *@param array $data [description]
      *@return array [description]
      */
    public function companion_solicitud( $data = array() ){

        $where = [
                'id_solicitud' => $data->id_solicitud
                ,'id_empresa' => $data->id_empresa
                #,'id_usuario' => $data->id_usuario
        ];
         #se hace la cosulta realizada por identifocado
        $response = MasterModel::show_model([],$where,new CatSolicitudCompanion);
        #$response = CatSolicitudCompanion::where($where)->get();
        $result = [];
        $i = 0;
        if (count($response) > 0) {
            foreach ($response as $response) {
                $result['id_acompañante'][$i] = $response->id_usuario; 
                $i++;
            }

        }      
          return $result;
    
    }
     /**
      *Metodo donde se genera la consulta de las etiquetas y sus nombres de los viaticos
      *@access public
      *@param $data array [ description ]
      *@return array [description]
      */
     /*public function viaticos_etiqueta( $data = array() ){

         $where = ( isset($data->id_viatico) )? ['id_etiqueta' => $data->id_viatico] : [ 'etiqueta_nombre' => $data->viatico ];
         $response = TblEtiqueta::where( $where )->get();
         $result = [];
         foreach ($response as $response) {
             $result =[
                'etiqueta_nombre'   =>  $response->etiqueta_nombre
                ,'id_viatico'       =>  $response->id_etiqueta
             ];
         }
         return $result;

     }*/
     /**
      *Se crea un metodo donde se hace toda la inserccion de las tablas que se realcionan
      *@access public 
      *@return array $result [ description ]
      */
    public function transaccion_insert( $result = array() ){
        #se realiza la transaccion porque son varios datos que se insertaran y haga un rollback en caso de error  
        
        DB::beginTransaction();
        try {
            #se manda a llamar una funcion para insertar la parte de solicitudes de viajes

            #$id_solicitud = self::insert_solicitud($result);
            $id_solicitud = MasterModel::insert_model([$result],new TblSolicitud)[0]->id_solicitud;
            if (!$id_solicitud) {
                return ['success' => false, 'menssage' => "Solicitud debe contener registro "];
            }

            for ($i=0; $i < count($result->viaticos_detalles); $i++) {

                    $datos = [
                        'id_viatico'                => self::viaticos_etiqueta($result->viaticos_detalles[$i])['id_viatico']
                        ,'id_solicitud'             => $id_solicitud
                        ,'id_empresa'               => $result->id_empresa
                        ,'id_usuario'               => $result->id_usuario
                        ,'viatico_cantidad'         => $result->viaticos_detalles[$i]->viatico_cantidad
                        ,'viatico_unidad'           => $result->viaticos_detalles[$i]->viatico_unidad
                        ,'viatico_costo_unitario'   => $result->viaticos_detalles[$i]->viatico_costo_unitario
                    ];
                    #se realiza la inserccion de los datos
                    #debuger($datos);
                    CatViaticoDetalle::create($datos);
                    self::insert_montos_transaccion($result->viaticos_detalles[$i]->montos_viaticos, $datos);

            }

            for ($i=0; $i < count($result->acompanantes); $i++) {
                    $request = [
                        'id_solicitud'              => $id_solicitud
                        ,'id_empresa'               => $result->id_empresa
                        ,'id_usuario'               => (isset($result->acompanantes[$i]->id_acompanante))? $result->acompanantes[$i]->id_acompanante: false
                    ];
                    CatSolicitudCompanion::create( $request );
            }

        }
        #Ha ocurrido un error, devolvemos la BD a su estado previo y hacemos lo que queramos con esa excepción
        catch (\Exception $e)
        {
                DB::rollback();
                #Informemos con un echo
                return ['success' => false, 'menssage' => $e->getMessage() ];
        }
        #Hacemos los cambios permanentes ya que no hay errores
        DB::commit();
        return $this->show( ['id_solicitud' => $id_solicitud] );

    }
     /**
      *Metodo para la creacion de los montos
      *@access public
      *@param $response [array] [description]
      *@param $data [integer] [description]
      *@return void
      */
    public function insert_montos_transaccion( $response = array(), $data ){

            try {
                
                for ($i=0; $i < count($response); $i++) { 

                        $data = [
                            'id_solicitud'                  => $data['id_solicitud']    
                            ,'id_viatico'                   => $data['id_viatico']
                            ,'id_empresa'                   => $data['id_empresa']
                            ,'id_usuario'                   => $data['id_usuario']
                            ,'monto_tipo_solicitud'         => $response[$i]->monto_tipo_solicitud
                            ,'monto_tipo_pago'              => $response[$i]->monto_tipo_pago
                            ,'monto_importe'                => $response[$i]->monto_importe
                            ,'monto_importe_autorizado'     => $response[$i]->monto_importe_autorizado
                        ];
                        CatSolicitudMonto::create( $data );
                    }


            } catch (\Exception $e) {
                #Informemos con un echo
                DB::rollback();
                print_r (['success' => false, 'menssage' => $e->getMessage() ] ) ;
                die();
            }
            DB::commit();
    
    }
     /**
      *Metodo para la creacion de solicitudes.
      *@access public 
      *@param array $response [description]
      *@return void
      */
   /* public function insert_solicitud( $response = array() ){

             TblSolicitud::create([
                    'id_proyecto'                     => $response->id_proyecto
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
                ]);
                $result = [];
                $data = TblSolicitud::latest()->limit(1)->get();
                if (count($data) > 0) {
                    foreach ($data as $response) {
                        $result[] = [
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
                    return $result[0]['id_solicitud'];
                }

    }*/



     
}
