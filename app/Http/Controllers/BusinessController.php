<?php

namespace App\Http\Controllers;

use Response;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Web\MasterWebController;

class BusinessController extends MasterWebController
{

 /**
  *Metodo para listar las empresas por usuario logueado
  *@access public 
  *@return void
  */   
    public function lista(){
        
        $forget = ['business_id','group_id','business_description'];
        Session::forget($forget);
        $url = 'http://52.44.90.182/api/userCompanies/';
        $headers = ['Content-Type' => 'application/json'];
        $data = ['token' => Session::get('token') ,'usuario' => Session::get('user_id') ];
        $method = 'post';
        $response = self::endpoint($url,$headers,$data,$method);
        #se manda a llamar la vista correspondiente para mostrarla
        $rows = (isset($response->rows))? $response->rows : [];
        $registros = [];
        $i = 1;
        foreach ($rows as $response) {
            $params = [
                'id_grupo'          => $response->id_grupo
                ,'id_empresa'       => $response->empresa
                ,'description'      => $response->nombreGrupo
                ,'rfc'              => $response->rfc
            ];
            $registros[] = [
                ''                      => $i
                ,'id_grupo'             => $response->id_grupo
                ,'nombreGrupo'          => $response->nombreGrupo
                ,'empresa'              => $response->empresa
                ,'rfc'                  => $response->rfc
                ,'razonSocial'          => $response->razonSocial
                ,'acciones'             => build_acciones( $params ,'business',false,'btn btn-info',"fa fa-list",'data-toggle="tooltip" title="Seleccione Empresa"')
            ];

            $i++;
        }


        $titulos = [
                     '#'   
                    ,'Id Grupo'
                    ,'Nombre Grupo'
                    ,'Id Empresa'
                    ,'RFC'
                    ,'Razon Social'
                    ,'Acciones'
                ];
        $table = array(
                'titulos'       => $titulos
                ,'registros'    => $registros
                ,'class'        => "table table-hover table-striped table-response"
        );
        $data = [ 
            'tabla_empresas' => data_table_general($table)];
        #debuger($data);
        if ( !isset($response->error) ) {
            return view('list_bussines',$data);
        }
            return view('auth.login');
        #return view( 'list_bussines',['lista' => $zonerResponseBusi] );
    }
    /**
     *Metodo que se encarga de crear variables de sesion de la empresa con su respectivo empleado
     *@access public
     *@param Request $request [description]
     *@return json
     */
        public function generateBusiness(Request $request){
            
            $put = [
                'business_id'               => $request->id
                ,'group_id'                 => $request->group_id
                ,'business_description'     => $request->description
                ,'rfc'                      => $request->rfc
            ];
            Session::put( $put );
            return message(true,[],false);
        }
        
}
