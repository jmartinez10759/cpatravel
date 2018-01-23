<?php

namespace App\Http\Controllers;

use DB;
use Log;
use Response;
use Mockery\Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Template\TemplateController;

class AuthController extends Controller
{

    public function index()
    {
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd('entra a la funcion');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            
            #$url= 'http://cpaaccess.cpalumis.com.mx/api/usuario/login';
            $client = new Client();
            $url= 'http://52.44.90.182/api/login';   
        #manda a llamar el servicio para saber si existe el usuario a logguear
            $response = $client->post($url, [
                'headers'=> [
                    'Content-Type' => 'application/json'
                ],
                'body'    =>json_encode([
                    "email"     =>$request->email,
                    "password"  =>$request->password,
                    "servicio"  =>"7",
                    #"origen"    =>"web"
                    ])
            ]);

            $zonerStatusCode = $response->getStatusCode();
            $zonerResponse = json_decode($response->getBody());
        #valida si el mensaje de success es true y almacena los datos en session
            if( isset($zonerResponse->success) ){
                $request->session()->put('user_id', $zonerResponse->request->user_id );
                $request->session()->put('token',trim($zonerResponse->request->token));
                $request->session()->put('name',$zonerResponse->request->name);
                $request->session()->put('img',$zonerResponse->request->img);
                $request->session()->put('lastName',$zonerResponse->request->lastName);
                $request->session()->put('rol',$zonerResponse->request->rol);
                $request->session()->put('structure',$zonerResponse->request->structure);
                
                return redirect()->route('list');

            } else if( isset($zonerResponse->sucess) && $zonerResponse->sucess){
                #este es el servicio de prueba 
                $response = $zonerResponse->usuario[0];
                $request->session()->put('user_id', $response->usuario );
                $request->session()->put('token',trim($zonerResponse->token));
                $request->session()->put('name',$response->nombre);
                return redirect()->route('list');
            }

            return redirect('/');

        } catch (\Exception $e) {
            dd($e->getMessage());
            dd('algo ocurrio');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public  function logout(){
       # echo "redirecino";exit();

        Session::forget('user_id');
        Session::forget('token');
        Session::forget('business_id');
        Session::forget('goup_id');
        Session::forget('business_description');

        Session::forget('name');
        Session::forget('img');
        Session::forget('lastName');
        Session::forget('request_id');

        return redirect('/');
    }

    public function autocompletSearch(Request $request){
        $query = (!empty($request->input('query'))) ? strtolower($request->input('query')) : null;

        $databaseUsers = array(
            array(
                "id"        => 4152589,
                "username"  => "ricardo@cpavs.mx",
                "name"      => "Ricardo apellido_1 apellido_2"
            ),
            array(
                "id"        => 7377382,
                "username"  => "omar@cpavs.mx",
                "name"      => "Omar apellido_1 apellido_2"
            ),
            array(
                "id"        => 748137,
                "username"  => "juliocastrop@cpavs.mx",
                "name"      => "julio apellido_1 apellido_2"
            )
        );

        $resultUsers = [];
        foreach ($databaseUsers as $key => $oneUser) {
            if (strpos(strtolower($oneUser["username"]), $query) !== false ||
                strpos(str_replace('-', '', strtolower($oneUser["username"])), $query) !== false ||
                strpos(strtolower($oneUser["id"]), $query) !== false) {
                $resultUsers[] = $oneUser;
            }
        }

        return response()->json($resultUsers);

    }


}
