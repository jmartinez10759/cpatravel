<?php

namespace App\Http\Controllers\Apirest;

use Session;
use GuzzleHttp\Client;
use Mockery\Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    
	private $_api;
	private $_url;

	public function __construct(){
		$this->middleware('guest')->only('auth');
		$this->_api = new Client();
		$this->_url = "http://52.44.90.182/api/login";
	}
/** 
 *Metodo para el acceso al endpoint
 *@access public
 *@param object [description]
 *@return json 
 */
	public function auth(Request $request){
		try {
            $response = $this->_api->post($this->_url, [
                						'headers'=> ['Content-Type' => 'application/json'],
                						'body'   => json_encode([
											                    "email"     => $request->email,
											                    "password"  => $request->password,
											                    "servicio"  => 7
											                    #"origen"    =>"web"
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
