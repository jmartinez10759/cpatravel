<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class TblSubProyecto extends Model
{
    protected $table ="tbl_subproyectos";
    public $fillable = [
    	'id_subproyecto'
    	,'id_proyecto'
    	,'nombre'
    	,'sub_proyecto'
    	,'status'
    ];
    /**
     *Metodo model donde se obtienen los registros 
     *@access public
     *@param 
     *@param 
     */
    public static function consulta( $where = array() ){

    	$id_proyecto = ( isset($where['id_proyecto']) )? "tsub.id_proyecto = :id_proyecto":false;
    	$id_subproyecto = ( isset($where['id_subproyecto']) )? "tsub.id_subproyecto = :id_subproyecto":false;

    	$response = DB::select('SELECT 
    						tsub.* 
    						FROM tbl_subproyectos tsub
    						WHERE '.$id_proyecto.$id_subproyecto,$where
    					   );


    	if ( count($response) > 0) {
    		return message(true,$response,"Consulta exitosa");
    	}else{
    		return message(false,[],"Registros no encontrados.");
    	}

    }


}
