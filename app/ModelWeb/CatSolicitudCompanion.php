<?php

namespace App\ModelWeb;

use Illuminate\Database\Eloquent\Model;

class CatSolicitudCompanion extends Model
{
    protected $table = "cat_solicitudes_companion";
    public $fillable = [
    	'id_companion'
    	,'id_solicitud'
        ,'id_empresa'
        ,'id_usuario'
        ,'status'
    ];

}
