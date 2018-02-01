<?php

namespace App\ModelWeb\estado_cuenta;

use Illuminate\Database\Eloquent\Model;

class MovimientosWebModel extends Model
{
    protected $table = "movimientos";
    public $fillable = [
    	'id_movimiento'
		,'descripcion'
		,'afecta_saldo'
		,'id_estatus'
		,'usuario'
		,'administrador'
		,'proceso'
    ];
}









