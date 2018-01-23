<?php
namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Client;
use Request;

class AuthToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $client = new Client();
            $body =[];
            $body['token'] ='bearer '.$request->header('authorization');
            $url= 'http://cpaaccess.cpalumis.com.mx/api/usuario/validaToken';
            $response = $client->post($url, ['headers'=>
                [
                    'Authorization' => $body['token']
                ]]);
            $zonerStatusCode = $response->getStatusCode();
            $zonerResponse = json_decode($response->getBody());
            return $next($request);
        } catch (\Exception $e) {
            $messesage = $e->getMessage();
            if(strpos($messesage,'token_invalid') !== FALSE){
                dd(json_encode(['error' => false,'message' =>'token_invalid']));
                //response()->json(['error' => false,'message' =>'token_invalid']);
            }else if(strpos($messesage,'token_expired') !== FALSE){
                dd(json_encode(['error' => false,'message' =>'token_expired']));
                //return response()->json(['error' => false,'message' =>'token_expired']);
            }else{
                dd(json_encode(['error' => false,'message' =>'algo paso verifica el token']));
                //return response()-jason(['error' => false,'message' =>'algo_paso']);
            }
        }
    }
}
