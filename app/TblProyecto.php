<?php

namespace App;

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

}
