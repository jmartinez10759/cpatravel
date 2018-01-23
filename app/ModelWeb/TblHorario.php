<?php

namespace App\ModelWeb;

use Illuminate\Database\Eloquent\Model;

class TblHorario extends Model
{
    protected $table = "tbl_horarios";
    public $fillable = [
    	'id_horario'
    	,'rango'
    	,'status'
    ];
}
