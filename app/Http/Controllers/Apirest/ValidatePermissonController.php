<?php

namespace App\Http\Controllers\Apirest;

use Session;
use GuzzleHttp\Client;
use Mockery\Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
#use App\Http\Controllers\Apirest\MasterController;

class ValidatePermissonController extends Controller
{
    public function __construct(){
    	$this->middleware('guest')->only('token');
    }
	/**
	 *Metodo para validar el token generado por access
	 *@access public
	 *@param object $request []
	 *@return json
	 */
	public static function permisson ( $request ){

		try {
			$api = new Client();
			$url = "http://52.44.90.182/api/privileges";
  			
  			$response = $api->post($url, [
                						'headers'=> ['Content-Type' => 'application/json'],
                						'body'   => json_encode([
											                    "token"     =>  $request->token,
											                    "usuario"   =>  $request->usuario,
											                    "producto"  =>  7
                									])
            ]);

            $status = $response->getStatusCode();
            $respuesta = json_decode($response->getBody());
            if (!isset( $respuesta->error )) {
                return $respuesta->rows[0]->perfil_id;
            }
            return json_encode( $respuesta );
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }


	}
}
