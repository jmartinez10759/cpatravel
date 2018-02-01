<?php

namespace App\ModelWeb\estado_cuenta;

use Illuminate\Database\Eloquent\Model;

class EstadoCuentaWebModel extends Model
{
    protected $table = "estadocuentas";
    public $fillable = [
    	'id_cuenta'
		,'id_proyecto'
		,'id_subproyecto'
		,'id_viaje'
		,'id_movimiento'
		,'id_etiqueta'
		,'id_relacion'
		,'id_usuario'
		,'id_empresa'
		,'status'
		,'fecha'
		,'importe'
		,'importe_comprobado'
		,'proceso'
		,'metodo_pago'
    ];

















}
