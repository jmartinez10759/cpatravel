<?php

namespace App\Model\Apirest;

use Illuminate\Database\Eloquent\Model;

class ComprobanteDetalleApiModel extends Model
{
    protected $table = "comprobantes_detalles";
    public $fillable = [
			'id_comprobante_detalle'
			,'id_comprobante'
			,'concepto'
			,'clave_prod'
			,'cantidad'
			,'unidad'
			,'descripcion'
			,'valor_unitario'
			,'importe'
    ];
    
}
