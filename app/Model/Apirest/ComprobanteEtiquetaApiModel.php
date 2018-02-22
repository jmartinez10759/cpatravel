<?php

namespace App\Model\Apirest;

use Illuminate\Database\Eloquent\Model;

class ComprobanteEtiquetaApiModel extends Model
{
    protected $table = "comprobantes_etiquetas";
    public $fillable = [
			'id_comprobante_etiqueta'
            ,'id_comprobante_detalle'
            ,'id_comprobante'
            ,'id_etiqueta'
    ];
}
