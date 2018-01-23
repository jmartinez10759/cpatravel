<?php

namespace App\Http\Controllers\Apirest;

use Session;
use GuzzleHttp\Client;
use Mockery\Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ValidateTokenController extends Controller
{

    public function __construct(){
    	$this->middleware('guest')->only('token');
    }
/**
 *Metodo para validar el token generado por access
 *@access public
 *@param object $request []
 *@return json [boolean]
 */
	public static function token ( $request ){
		try {

			$api = new Client();
			$url = "http://52.44.90.182/api/userData";

            $response = $api->post($url, [
                						'headers'=> ['Content-Type' => 'application/json'],
                						'body'   => json_encode([
											                    "token"     =>  $request->token,
											                    "usuario"   =>  $request->usuario
                									])
            ]);

            $status = $response->getStatusCode();
            $respuesta = json_decode($response->getBody());
            $respuesta = (isset($respuesta->error))? [ "success" => false ] : [ "success" => true ];
            return json_encode($respuesta);

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }


	}


}
