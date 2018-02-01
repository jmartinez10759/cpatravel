<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MasterModel extends Model
{
    

	/**
	 *Metodo Model General para hacer consultas por medio de condiciones
	 *@access public 
	 *@param array $params [description]
	 *@param array $where [description] 
	 *@param object $clase [description] 
	 *@return array 
	 */
	public static function show_model( $params = array(), $where= array(), $clase= false ){
		
		if ( $where ) {
			
			if ( $params) { $response = $clase::where( $where )->select( $params )->get();}
			else{ $response = $clase::where( $where )->get(); }

		}else{ $response = $clase::all(); }

		$result = [];
		$i = 0;
		foreach ($response as $respuesta) {

			if ($params) {
				
				foreach ($params as $key => $value) {
					$result[$i][$value] = $respuesta->$value;
				}

			}else{
				
				foreach ($clase->fillable as $key => $value) {
					$result[$i][$value] = $respuesta->$value;
				}

			}
			$i++;
		}
		return array_to_object($result);

	}



}
