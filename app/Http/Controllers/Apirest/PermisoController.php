<?php

namespace App\Http\Controllers\Apirest;

use Session;
use GuzzleHttp\Client;
use Mockery\Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermisoController extends Controller
{
    private $_api;
	private $_url;

	public function __construct(){
		$this->middleware('guest')->only('permission');
		$this->_api = new Client();
		$this->_url = "http://52.44.90.182/api/privileges";
	}
/** 
 *Metodo para el acceso al endpoint
 *@access public
 *@param object [description]
 *@return json 
 */
	public function permission(Request $request){
		try {
            $response = $this->_api->post($this->_url, [
                						'headers'=> ['Content-Type' => 'application/json'],
                						'body'   => json_encode([
											                    "token"     =>  $request->token,
											                    "usuario"   =>  $request->usuario,
											                    "producto"  =>  7
                									])
            ]);

            $status = $response->getStatusCode();
            $respuesta = json_decode($response->getBody());
            return response()->json($respuesta);

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
	}
}