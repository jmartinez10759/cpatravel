<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Client;

class AuthSession
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
            $user_id = $request->session()->get('user_id');
            $token = $request->session()->get('token');
            $client = new Client();
            $body =[];
            $body['token'] ='bearer '.$token;
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
                return redirect('/');
            }else if(strpos($messesage,'token_expired') !== FALSE){
                return redirect('/');
            }else{
                return redirect('/');
            }
        }
    }
}
