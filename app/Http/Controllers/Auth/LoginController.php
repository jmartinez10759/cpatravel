<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Response;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
/**
 *Metodo para crear el endpoint de loggin 
 *@access public 
 *@param object Request $request [description]
 *@return json [description]
 */
    public static function login (Request $request){
        try {
            $client = new Client();
            #$url= 'http://cpaaccess.cpalumis.com.mx/api/usuario/login';
            $url= 'http://52.44.90.182/api/login';

            $response = $client->post($url, [
                'headers'=> [
                    'Content-Type' => 'application/json'
                ],
                'body'    =>json_encode([
                    "email"     => $request->email,
                    "password"  => $request->password,
                    "servicio"  => $request->servicio
                    #"origen"    =>"web"
                ])
            ]);
            $zonerStatusCode = $response->getStatusCode();
            $zonerResponse = json_decode($response->getBody());
            return response()->json($zonerResponse);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }

    }

}
