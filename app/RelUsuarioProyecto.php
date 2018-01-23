<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelUsuarioProyecto extends Model
{
   	protected $table = "rel_usuarios_proyectos";
    protected $fillable = [
    	'id_usuario'
    	,'id_proyecto'
    	,'id_subproyecto'
    	,'id_viaje'
    ];
}
