<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Session;

class ServiciosController extends Controller
{
    public static function getProfile($id){
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
    }

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

    public static function getStateBusiness($state){
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
            //dd($zonerResponse->stages);
            $i=0;
            foreach ($zonerResponse->stages as $zo){
                if($i == $state){
                    return response()->json($zo);
                }
                $i++;
            }
            return response()->json($zonerResponse);
        }catch (\Exception $e){
            dd($e->getMessage());
            dd('algo ocurrio');
        }
    }
}
