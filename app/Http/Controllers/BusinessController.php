<?php

namespace App\Http\Controllers;

use Response;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Template\TemplateController;

class BusinessController extends TemplateController
{

 /**
  *Metodo para listar las empresas por usuario logueado
  *@access public 
  *@return void
  */   
    public function lista(){
        
        #se agregan en session
        Session::forget('business_id');
        Session::forget('group_id');
        Session::forget('business_description');

        $client = new Client();
        $urlBussines = "http://52.44.90.182/api/userCompanies/";
        #$urlBussines = "http://cpaaccess.cpalumis.com.mx/api/usuario/businessListing";
        $responseBussines = $client->post($urlBussines, [
            'headers'=> [
                'Content-Type' => 'application/json',
                #'Authorization'=> 'bearer '.Session::get('token')
            ],
            'body' => json_encode([
                        "token"     => Session::get('token'),
                        "usuario"   => Session::get('user_id'),
                    ])
        ]);
        $zonerStatusCodeBusi = $responseBussines->getStatusCode();
        $zonerResponseBusi = json_decode($responseBussines->getBody());
        #se manda a llamar la vista correspondiente para mostrarla
        #debuger($zonerResponseBusi->rows);
        $rows = (isset($zonerResponseBusi->rows))? $zonerResponseBusi->rows : [];
        $registros = [];
        $i = 1;
        foreach ($rows as $response) {
            $params = [
                'id_grupo'          => $response->id_grupo
                ,'id_empresa'       => $response->empresa
                ,'description'      => $response->nombreGrupo
            ];
            $registros[] = [
                ''                      => $i
                ,'id_grupo'             => $response->id_grupo
                ,'nombreGrupo'          => $response->nombreGrupo
                ,'empresa'              => $response->empresa
                ,'rfc'                  => $response->rfc
                ,'razonSocial'          => $response->razonSocial
                ,'acciones'             => build_acciones( $params ,'business',false,'btn btn-info',"fa fa-list",false)
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
            'lista' => $zonerResponseBusi
            ,'tabla_empresas' => data_table_general($table)
        ];
        #debuger($data);
        if (!isset($data['lista']->error)) {
            #return $this->load_view('list_bussines',$data);
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
            
            $request->session()->put('business_id',$request->id);
            $request->session()->put('group_id',$request->group_id);
            $request->session()->put('business_description',$request->description);
            return response()->json(['success' => true ]);
        }
        
}
