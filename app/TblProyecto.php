<?php

namespace App;

use App\Model\MasterModel;
use Illuminate\Database\Eloquent\Model;


class TblProyecto extends Model
{
    protected $table ="tbl_proyectos";
    public $fillable = [
    	'id_proyecto'
    	,'id_empresa'
    	,'nombre'
    	,'proyecto'
    	,'status'
    ];
    /**
     *Metodo modelo para hacer la consulta con condicion
     *@access public
     *@param  
     *@param 
     *@param 
     *@return json 
     */
    public static function consulta_proyecto_model( $params = array(), $where = array() ){

    	$response = MasterModel::show_model($params,$where,new TblProyecto);
    	debuger($response);

    }


}
