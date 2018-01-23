<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class TblViaje extends Model
{
    protected $table = "tbl_viajes";
    public $fillable = [
    	'id_viaje'
    	,'id_proyecto'
    	,'id_subproyecto'
    	,'nombre'
    	,'viaje'
    	,'status'
    ];
    /**
     *Metodo model donde se obtienen los registros 
     *@access public
     *@param $where [description]
     *@return json 
     */
    public static function consulta_model( $where = array() ){

    	$id_proyecto = ( isset($where['id_proyecto']) )? "AND tv.id_proyecto = :id_proyecto":false;
    	$id_subproyecto = ( isset($where['id_subproyecto']) )? " AND tv.id_subproyecto = :id_subproyecto":false;
    	$id_viaje  = ( isset($where['id_viaje']) )? " AND tv.id_viaje = :id_viaje":false;

    	$response = DB::select('SELECT 
    							tv.* 
    							FROM tbl_viajes tv
    							WHERE 1 '.$id_proyecto.$id_subproyecto.$id_viaje, $where
    					  	 );


    	if ( count($response) > 0) {
    		return message(true,$response,"Consulta exitosa");
    	}else{
    		return message(false,[],"Registros no encontrados.");
    	}

    }
}
