<?php

namespace App\Http\Controllers;

use DB;
use Log;
use Response;
use Mockery\Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Web\MasterWebController;

class AuthController extends MasterWebController
{

    /*public function index()
    {
        return view('home');
    }*/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   /* public function create()
    {
        dd('entra a la funcion');
    }*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            
          /*  #$url= 'http://cpaaccess.cpalumis.com.mx/api/usuario/login';*/
            $url        = 'http://52.44.90.182/api/login';
            $headers    = ['Content-Type' => 'application/json'];
            $data       = ['email' => $request->email ,'password' => $request->password ,'servicio' =>7];
            $method     = 'post';
            $response   = self::endpoint($url,$headers,$data,$method);

            if ( isset( $response->sucess ) && $response->sucess == true) {
                $session = [
                    'user_id'   => $response->usuario[0]->usuario
                    ,'token'    => $response->token
                    ,'name'     => $response->usuario[0]->nombre
                ];
                Session::put($session);

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
    /*public function show($id)
    {
        //
    }*/

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function edit($id)
    {
        //
    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function update(Request $request, $id)
    {
        //
    }*/

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function destroy($id)
    {
        //
    }*/
    /**
     *Metodo para destruir las sessiones activas y salir del sistema
     *@access public
     *@return void
     */
    public function logout(){

        $logout =['user_id','token','business_id','group_id','business_description','name','lastName','request_id','img'];
        Session::forget($logout);
        return redirect('/');

    }

    /*public function autocompletSearch(Request $request){
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

    }*/


}
