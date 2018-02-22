<?php

namespace App\Model\Apirest;

use Illuminate\Database\Eloquent\Model;

class ComprobanteApiModel extends Model
{
    protected $table = "comprobantes";
    public $fillable = [
		'id_comprobante'
		,'id_usuario'
		,'id_empresa'
		,'id_proyecto'
		,'id_subproyecto'
		,'id_viaje'
		,'uuid'
		,'rfc_emisor'
		,'rfc_receptor'
		,'importe'
		,'comentarios'
		,'fecha_emision'
		,'estatus'
		,'concepto'
		,'imagen'
    ];

}
