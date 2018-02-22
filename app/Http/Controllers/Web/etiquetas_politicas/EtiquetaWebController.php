<?php

namespace App\Http\Controllers\Web\etiquetas_politicas;

use Session;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use App\Model\Apirest\TblEtiqueta;
use App\Model\Apirest\TblPolitica;
use App\Http\Controllers\Web\MasterWebController;

class EtiquetaWebController extends MasterWebController
{
   
    public function __construct(){

        parent::__construct();
        $this->session_expire();
    } 
    /**
     *Metodo controller para mostrar la vista de Etiquetas y politicas
     *@access public
     *@return html
     */
    public function index(){

    	#se realiza la consulta para obtener todas las etiquetas
    	$url = "http://".$this->_domain."/api/travel/etiquetas";
        $headers = [ 
            'Content-Type'  => 'application/json'
            ,'usuario'      => $_SERVER['HTTP_USUARIO']
            ,'token'        => $_SERVER['HTTP_TOKEN']
        ];
        $method = 'get';
    	$response = self::endpoint($url,$headers,[],$method);
        #debuger(Session::get('user_id'));
        $predeterminada = [];
        $usuario = [];
        $corporativas = [];

        if ( $response->success == true ) {
            $response = $response->result;
            $i = 1;
            foreach ( $response as $response) {
                $params = [
                	'id_etiqueta' 	=> $response->id_etiqueta
                	#,'id_usuario' 	=> $response->id_usuario
                	,'id_empresa' 	=> $response->id_empresa
                    ,'url'          => $response->etiqueta_img
            	];
                #if ( $this->_tipo_user != 21 ) { $params['id_usuario'] = $_SERVER['HTTP_USUARIO']; }

            	if ($response->etiqueta_tipo == "predeterminadas") {
            		
		                $predeterminada[] = [

		                    'icon'  =>  build_img($params,"detalles_etiqueta",$response->etiqueta_img,'data-toggle="tooltip" title="'.$response->etiqueta_nombre.'"' )
		                    ,'etiqueta_nombre'          =>  $response->etiqueta_nombre
		                ];

            	}
            	/*if ($response->etiqueta_tipo == "usuario") {
                     #$url = "http://".$this->_domain."/api/travel/etiquetas?id_usuario=".Session::get('user_id');
                     #$response = self::endpoint($url,$headers,[],$method);
                     $params['id_usuario'] = Session::get('user_id');
                     $usuario[] = [
                            'icon'  =>  build_img($params,"detalles_etiqueta",$response->etiqueta_img,'data-toggle="tooltip" title="'.$response->etiqueta_nombre.'"' )
                            ,'etiqueta_nombre'          =>  $response->etiqueta_nombre
                            ,'borrar' => build_acciones($params,'borrar_etiqueta',"",'btn btn-danger',"fa fa-trash",'data-toggle="tooltip" title="Eliminar Etiqueta" ')
                        ];           		

            	}*/
            	if ($response->etiqueta_tipo == "corporativas") {
            		
                    $corporativas[] = [

                            'icon'  =>  build_img($params,"detalles_etiqueta",$response->etiqueta_img,'data-toggle="tooltip" title="'.$response->etiqueta_nombre.'"' )
                            ,'etiqueta_nombre'          =>  $response->etiqueta_nombre
                            ,'borrar' => build_acciones($params,'borrar_etiqueta',"",'btn btn-danger',"fa fa-trash",'data-toggle="tooltip" title="Eliminar Etiqueta" ')
                        ];

            	}

                $i++;
            }

        }else{

            die( view('auth.session_expire') );
        }
        $titulos = [];
        $table_predeterminada = array(
                'titulos'       => $titulos
                ,'registros'    => $predeterminada
                ,'class'        => "table table-striped table-bordered table-hover"
                ,'class_thead'  => ""
                ,'class_tr'     => "detalles_etiqueta"
        );
        $table_usuario = array(
                'titulos'       => $titulos
                ,'registros'    => $usuario
                ,'class'        => "table table-striped table-bordered table-hover"
                ,'class_thead'  => ""
                ,'class_tr'     => "detalles_etiqueta"
        );
        $table_corporativas = array(
                'titulos'       => $titulos
                ,'registros'    => $corporativas
                ,'class'        => "table table-striped table-bordered table-hover"
                ,'class_thead'  => ""
                ,'class_tr'     => "detalles_etiqueta"
        );

    	$data = [
    		'usuario' 			    =>  Session::get('name')
    		,'avatar'   		    =>  ( !is_null(Session::get('img') ) )? Session::get('img') : asset('images/avatar.jpeg')
            ,'table_etiquetas'      =>  data_table_general( $table_predeterminada )
            ,'table_usuario'        =>  data_table_general( $table_usuario )
    		,'table_corporativas' 	=>  data_table_general( $table_corporativas )
    	];
        #debuger($data);
    	return view('politicas.etiquetas_politicas.etiquetas_politicas',$data);

    }
    /**
     *Metodo Controller donde se realiza el insert de etiquetas y politicas
     *@access public
     *@param Request $request [descrption]
     *@return json
     */
    public function save_etiquetas( Request $request ){
        
        #se manda a llamar el endpoint para insertar las politicas y etiquetas
        $url    = "http://".$this->_domain."/api/travel/etiquetas";
        $urls   = "http://".$this->_domain."/api/travel/politicas";
        $headers = [ 
            'Content-Type'  => 'application/json'
            ,'usuario'      => $_SERVER['HTTP_USUARIO']
            ,'token'        => $_SERVER['HTTP_TOKEN']
        ];
        $data = [
            'data' =>[
                'id_usuario'             => $_SERVER['HTTP_USUARIO']
                ,'id_empresa'            => Session::get('business_id')
                ,'etiqueta_img'          => ($request->etiqueta_img)?$request->etiqueta_img:asset('images/etiquetas/etiqueta.png')
                ,'etiqueta_nombre'       => $request->etiqueta_nombre
                ,'etiqueta_descripcion'  => $request->etiqueta_descripcion
                ,'etiqueta_tipo'         => $request->etiqueta_tipo
                ,'etiqueta_tipo_img'     => "icon"
            ]
        ];
        $method = 'post';
        #debuger($data);
        $response = $this->endpoint($url,$headers,$data,$method);
        #debuger($response);
        if ($response->success == true) {

            $data = ["data" => [
                        'id_usuario'      => $_SERVER['HTTP_USUARIO']
                        ,'id_empresa'      => Session::get('business_id')
                        ,'importe_ded_nal' => $request->importe_ded_nal
                        ,'importe_ded_ext' => $request->importe_ded_ext
                        ,'importe_emp_nal' => $request->importe_emp_nal
                        ,'importe_emp_ext' => $request->importe_emp_ext
                        ,'tipo'            => $request->etiqueta_tipo
                        ,'status'          => 1
                        ,'id_etiqueta'     => $response->result[0]->id_etiqueta
                        ,'id_proyecto'     => 1
                        ,'id_subproyecto'  => 1
                        ,'id_viaje'        => 1
                ]
            ];
            #debuger(json_encode($data));
            $politicas = $this->endpoint($urls,$headers,$data,$method);
            if ($politicas->success == true) {
                return message($politicas->success,$politicas->result,$politicas->message);
            }else{
                return message($politicas->success,[],$politicas->message);
            }

        }else{
            return json_encode( ['success' => false] );
        }


    }
    /**
     *Metodo Controller donde se realiza el insert de etiquetas y politicas
     *@access public
     *@param Request $request [descrption]
     *@return json
     */
    public function detalles_politicas( Request $request ){
        
        #se realiza la consulta por medio de su ids y utilizando el servicio
        $id_usuario = (isset($request['id_usuario'] ) )? "&id_usuario=".$request->id_usuario : false;
        $url = "http://".$this->_domain."/api/travel/etiquetas?id_etiqueta=".$request->id_etiqueta.$id_usuario."&id_empresa=".$request->id_empresa;
        $urls = "http://".$this->_domain."/api/travel/politicas?id_etiqueta=".$request->id_etiqueta.$id_usuario."&id_empresa=".$request->id_empresa;
        #servicio de politicas
        $headers = [ 
            'Content-Type'  => 'application/json'
            ,'usuario'      => $_SERVER['HTTP_USUARIO']
            ,'token'        => $_SERVER['HTTP_TOKEN']
        ];
        $data = [];
        $method = 'get';
        $politicas = $this->endpoint($urls,$headers,$data,$method);
        $etiquetas = $this->endpoint($url,$headers,$data,$method);
        #debuger($politicas);
        if ($politicas->success == true && $etiquetas->success == true) {
            
            $response = [

                'etiqueta_img'          => $etiquetas->result[0]->etiqueta_img
                ,'etiqueta_nombre'       => $etiquetas->result[0]->etiqueta_nombre
                ,'etiqueta_descripcion'  => $etiquetas->result[0]->etiqueta_descripcion
                ,'etiqueta_tipo'         => $etiquetas->result[0]->etiqueta_tipo
                ,'etiqueta_tipo_img'     => $etiquetas->result[0]->etiqueta_tipo_img
                ,'id_politica'           => $politicas->result[0]->id_politica
                ,'importe_ded_nal'       => $politicas->result[0]->importe_ded_nal
                ,'importe_ded_ext'       => $politicas->result[0]->importe_ded_ext
                ,'importe_emp_nal'       => $politicas->result[0]->importe_emp_nal
                ,'importe_emp_ext'       => $politicas->result[0]->importe_emp_ext
                ,'tipo'                  => $politicas->result[0]->tipo
                ,'status'                => $politicas->result[0]->status
                ,'id_etiqueta'           => $politicas->result[0]->id_etiqueta
                ,'id_proyecto'           => $politicas->result[0]->id_proyecto
                ,'id_subproyecto'        => $politicas->result[0]->id_subproyecto
                ,'id_viaje'              => $politicas->result[0]->id_viaje

            ];
            #debuger($response);
            return message($politicas->success,$response,$politicas->message);

        }else{
            return message($politicas->success,[],$politicas->message);
        }

        return json_encode(['success' => false, "message" => "No se encontro ningun registro"]);


    }
    /**
     *Metodo Controller donde se realiza la actualizacion de etiquetas y politicas
     *@access public
     *@param Request $request [descrption]
     *@return json
     */
    public function actualizacion_politicas( Request $request ){

            $url        = "http://".$this->_domain."/api/travel/etiquetas";
            $urls       = "http://".$this->_domain."/api/travel/politicas";

            $headers = [ 
                'Content-Type'  => 'application/json'
                ,'usuario'      => $_SERVER['HTTP_USUARIO']
                ,'token'        => $_SERVER['HTTP_TOKEN']
            ];
            $data = [
                'data' =>[
                    'id_etiqueta'            => $request->id_etiqueta
                    ,'etiqueta_img'          => ($request->etiqueta_img)?$request->etiqueta_img:'ruta//'
                    ,'etiqueta_nombre'       => $request->etiqueta_nombre
                    ,'etiqueta_descripcion'  => $request->etiqueta_descripcion
                    ,'etiqueta_tipo'         => $request->etiqueta_tipo
                    ,'etiqueta_tipo_img'     => "icon"
                ]
            ];
            $method = 'put';
            #debuger($data);
            $response = $this->endpoint($url,$headers,$data,$method);
            #debuger($response);
            if ($response->success == true) {

                $data = ["data" => [
                            
                            'id_politica'     => $request->id_politica                            
                            ,'importe_ded_nal' => $request->importe_ded_nal
                            ,'importe_ded_ext' => $request->importe_ded_ext
                            ,'importe_emp_nal' => $request->importe_emp_nal
                            ,'importe_emp_ext' => $request->importe_emp_ext
                            ,'tipo'            => $request->etiqueta_tipo
                            ,'id_proyecto'     => 1
                            ,'id_subproyecto'  => 1
                            ,'id_viaje'        => 1
                    ]
                ];
                #debuger(json_encode($data));
                $politicas = $this->endpoint($urls,$headers,$data,$method);
                if ($politicas->success == true) {
                    #return json_encode(['success' => true, 'menssage' => $politicas->message]);
                    return message($politicas->success,$politicas->result,$politicas->message);
                }else{
                    return message($politicas->success,[],$politicas->message);
                }

            }else{
                return message($politicas->success,[],$politicas->message);
            }


    }
    /**
     *Metodo Controller donde se realiza eliminar etiquetas y politicas 
     *@access public
     *@param Request $request [descrption]
     *@return json
     */
    public function eliminar_politicas( Request $request ){
        #debuger($request->all());
        $where = [
            'id_etiqueta'   =>  $request->id_etiqueta
            ,'id_empresa'   =>  Session::get('business_id')
            ,'id_usuario'   =>  $_SERVER['HTTP_USUARIO']
        ];
        #debuger( $request->url );
        $url = "http://".$this->_domain."/images/etiquetas/etiqueta.png";
        if ( !empty($request->url) && $request->url != $url) {
            unlink( public_path().$request->url );
        }
        TblEtiqueta::where( $where )->delete();
        TblPolitica::where( $where )->delete();
        #Storage::delete($request->url);
        return json_encode( ['success' => true,'message' => "Se elimino correctamente el registro"] );

    }
    /**
     *Metodo Controller para subir archivos. 
     *@access public
     *@param Request $request [descrption]
     *@return json
     */
    public function upload( Request $request ){
        
        #debuger( $_FILES['file'] );
        $files = $request->file('file');
        $archivo = "";
        for ($i=0; $i < count($files) ; $i++) { 
            
            $nombre_temp = $files[$i]->getClientOriginalName();
            $extension = strtolower($files[$i]->getClientOriginalExtension());
            $archivo = "politicas_".date('Y-m-d_h:m:s')."_".$i.".".$extension;
            $path = public_path()."/images/etiquetas/";
            $files[$i]->move($path,$archivo);
        }

         $url = public_path().'/images/etiquetas/'.$archivo;
         //verificamos si el archivo existe y lo retornamos
         if ( file_exists($url) ){
           return json_encode( ['success' => true, 'url_file' => "/images/etiquetas/".$archivo ] );
         }else{
           return json_encode( ['success' => false] );
         }


    }




}
