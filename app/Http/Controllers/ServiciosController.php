<?php

namespace App\Http\Controllers;

use Session;
#use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\MasterWebController;

class ServiciosController extends MasterWebController
{
    
    /*public static function getProfile($id){
        try {
            $client = new Client();
            $url= 'http://cpaaccess.cpalumis.com.mx/api/usuario/profile';
            $response = $client->post($url, [
                'headers'=> [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'bearer '.Session::get('token')
                ],
                'body'    =>json_encode([
                    "idd"       => $id,
                    "permiso"   => "getProfile"])
            ]);
            $zonerStatusCode = $response->getStatusCode();
            $zonerResponse = json_decode($response->getBody());
            if($zonerResponse->success){
                return response()->json($zonerResponse);
            }else{

            }
        } catch (\Exception $e) {
            dd($e->getMessage());
            dd('algo ocurrio');
        }
    }*/
    /**
     *Metodos donde se realiza el consumo de la regla de negocio BPM 
     *@access public
     *@return json  [description]
     */
    public static function modeladoInbox(){

        try{
            $client = new Client();
            $url= 'http://inbox.cpalumis.com.mx//dummy/bpm/186/4234j2kl4bffso2h4324';
            $response = $client->get($url, [
                'headers'=> [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'bearer '.Session::get('token')
                ]
            ]);
            $zonerStatusCode = $response->getStatusCode();
            $zonerResponse = json_decode($response->getBody());
            return response()->json($zonerResponse);
        }catch (\Exception $e){
            dd($e->getMessage());
            dd('algo ocurrio');
        }


    }
    /**
     *Metodo para obtener el autorizardor por el monto solicitado
     *@access public
     *@param [description]
     *@return json [description]
     */
    public function bpm_auth(){

        $url = 'https://cpainbox.cpavision.mx/bpm/services/rules';
        $headers = ['Content-Type' => 'application/json'];
        $data = ["empresa" => 451 ,"proceso" => "Autorización de Víáticos"];
        $method = 'post';
        $response = self::endpoint($url,$headers,$data,$method);
        debuger($response);


    }



}
