<?php

namespace App\Http\Controllers\Web;

use Session;
use App\Label;
use App\Country;
use App\StatusAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\ModelWeb\CatSolicitudMonto;
use App\ModelWeb\CatSolicitudCompanion;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\Web\MasterWebController;

class AcompananteController extends MasterWebController
{
    private $_permits;
    
    public function __construct(){
        parent::__construct();
        $this->_permits=  self::verify_permison();
    }
    /**
     *Metodo para realizar la consulta de los montos por medio de id_viaticos
     *@access public
     *@param  Request $request [Description]
     *@return json
     */
    public static function guardar( $request ){

    	if ( count($request->acompanantes) == 0 ) {
    		return json_encode( ['success' => true, 'result' => $request->id_solicitud] ); 
    	}

    	DB::beginTransaction();
        try {
            #inicio de la transaccion
        		$result = [];
		    	for ($i=0; $i < count( $request->acompanantes ); $i++) { 
		    		
		    		$insert = [
		    			'id_solicitud' 		=> $request->id_solicitud
		    			,'id_empresa' 		=> $request->id_empresa
		    			,'id_usuario' 		=> $request->acompanantes[$i]
		    		];
					CatSolicitudCompanion::create( $insert );
		    	}

				$result = [];
		        $where = ['created_at' => date("Y-m-d H:i:s") ];
		        $data = CatSolicitudCompanion::where( $where )->get();
		        if ( count($data) > 0 ) {
		            foreach ($data as $response) {
		                $result[] = [
		                        'id_solicitud'              => $response->id_solicitud
						        ,'id_empresa'               => $response->id_empresa
						        ,'id_usuario'               => $response->id_usuario
		                    ]; 
		            }

		    	}           

        }
        #Ha ocurrido un error, devolvemos la BD a su estado previo y hacemos lo que queramos con esa excepción
        catch (\Exception $e)
        {
            DB::rollback();
            #Informemos con un echo
            return json_encode(['success' => false, 'menssage' => $e->getMessage() ]);
        }
        #Hacemos los cambios permanentes ya que no hay errores
        DB::commit();
        return json_encode( ['success' => true, 'result' => $result] ); 

	}


}
