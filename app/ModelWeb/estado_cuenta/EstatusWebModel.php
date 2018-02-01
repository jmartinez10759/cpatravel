<?php

namespace App\ModelWeb\estado_cuenta;

use Illuminate\Database\Eloquent\Model;

class EstatusWebModel extends Model
{
    protected $table = "estatus";
    public $fillable = [
		'id_estatus'
		,'descripcion'
		,'imagen'
    ];
}
