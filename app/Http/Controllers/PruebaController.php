<?php

namespace App\Http\Controllers;

use App\Label;
use App\Travel;
use Illuminate\Http\Request;
use Session;

class PruebaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function prueba(Request $request){
        dd(Session::all());
        dd('entra a funcion prueba');

    }

    public function search(){
        return view('pruebas.search');
    }

    public function autocomplete(Request $request){
        //dd($request->all());
        $data = Travel::where("name","LIKE","%{$request->input('query')}%")
            ->orWhere("label","LIKE","%{$request->input('query')}%")->get();
        return response()->json($data);

    }

    public function vista(){
        return view('pruebas.vista');
    }
/**
 *Se crea un metodo para desloguear al usuario en session  
 *@access public 
 *@return void
 */
public function logout(){
    return "llego aqui ";exit();
}



}
