<?php

namespace App\Model\Apirest;

use Illuminate\Database\Eloquent\Model;

class TblPolitica extends Model
{
    protected $table = "tbl_politicas";
    public $fillable = [
    	'id_politica'
    	,'importe_ded_nal'
        ,'importe_ded_ext'
        ,'importe_emp_nal'
    	,'importe_emp_ext'
    	,'status'
    	,'id_usuario'
    	,'id_empresa'
    	,'id_proyecto'
    	,'id_subproyecto'
    	,'id_viaje'
        ,'tipo'
    	,'id_etiqueta'
    ];
}
