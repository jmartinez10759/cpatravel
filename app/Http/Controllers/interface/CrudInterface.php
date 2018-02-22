<?php

namespace App\Http\Controllers\interface;
/*use Illuminate\Http\Request;
use App\Http\Controllers\Controller;*/

interface CrudInterface 
{
	
	public function index( Request $request );    
	public function all();    
	public function create( array $request );    
	public function show( $data );    
	public function update($request, $id);    
	public function destroy($id);

}
