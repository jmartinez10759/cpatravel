<?php

namespace App\Model\Apirest;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class TblEtiqueta extends Model
{
    protected $table = "tbl_etiquetas";
    public $fillable = [
    	'id_etiqueta'
    	,'id_usuario'
    	,'id_empresa'
    	,'etiqueta_img'
    	,'etiqueta_nombre'
    	,'etiqueta_descripcion'
    	,'etiqueta_tipo'
    	,'etiqueta_tipo_img'
    ];

    /**
     *Metodo Model de una consulta
     *@access public
     *@param $where array [descripcion]
     *@return json
     */
    public static function consulta_etiqueta( $where = array() ){

        $id_etiqueta = ( isset($where['id_etiqueta']) )? ' AND te.id_etiqueta = :id_etiqueta': false;
        $response = [];
        $query = DB::select('SELECT 
                                te.id_etiqueta
                                ,te.id_usuario
                                ,te.id_empresa
                                ,te.etiqueta_img
                                ,te.etiqueta_nombre
                                ,te.etiqueta_descripcion
                                ,te.etiqueta_tipo
                                ,te.etiqueta_tipo_img
                                ,tp.id_politica
                                ,tp.importe_ded_nal
                                ,tp.importe_ded_ext
                                ,tp.importe_emp_nal
                                ,tp.importe_emp_ext
                                ,tp.id_proyecto
                                ,tp.id_subproyecto
                                ,tp.id_viaje
                                FROM tbl_etiquetas te
                                INNER JOIN tbl_politicas tp ON te.id_etiqueta = tp.id_etiqueta
                                AND te.id_empresa =tp.id_empresa
                                #AND te.id_usuario = tp.id_usuario
                                WHERE te.id_empresa = :id_empresa'.$id_etiqueta,$where
                            );

        if ( count($query) > 0 ) {
            $response['success'] = true;
            $response['result'] = $query;
        }else{
            $response['success'] = false;
            $response['result'] = []; 
        }
        return json_encode( $response );


    }


}
