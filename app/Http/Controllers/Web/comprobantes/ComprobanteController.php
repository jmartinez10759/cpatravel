<?php

namespace App\Http\Controllers\Web\comprobantes;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Web\MasterWebController;

class ComprobanteController extends MasterWebController
{
    
    public function __construct(){

        parent::__construct();
        $this->session_expire();
    }
    /**
     *Metodo controller donse se carga la vista de la carga de la factura
     *@access public
     *@return void
     */
    public function register(){

    	$data = [
    		'titulo_principal' => "Ingresar Datos Factura"
    		,'usuario'         => Session::get('name')
            ,'avatar'          => ( !is_null(Session::get('img') ) )? Session::get('img') : asset('images/avatar.jpeg')
    	];
    	return view('comprobantes/comprobantes',$data);

    }
    /**
     *Metodo controller donde se hace una busqueda del CFDI
     *@access public 
     *@return void
     */
    public function busqueda(){
    	
		$data = [
    		'titulo_principal' => "Buscar Factura CFDI"
    		,'usuario'         => Session::get('name')
            ,'avatar'          => ( !is_null(Session::get('img') ) )? Session::get('img') : asset('images/avatar.jpeg')
    	];
    	return view('comprobantes/busquedas',$data);    	
    }




}
