<?php

use Illuminate\Database\Seeder;
use App\Model\Apirest\TblSolicitud;

class TblSolicitudesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	TblSolicitud::create([
				'id_proyecto' => 3
				,'id_subproyecto' => 5
				,'id_viaje' => 3
				,'id_usuario' => 27391 
				,'id_empresa' => 11613
				,'solicitud_fecha_inicio' => '2017-12-20' #yyyy-mm-dd
				,'solicitud_fecha_fin' => '2017-12-31' ##yyyy-mm-dd
				,'solicitud_horario_inicio' => "00:15"
				,'solicitud_horario_fin' => "22:00"
				,'solicitud_destino_inicio' => "Mexico"
				,'solicitud_destino_final' => "Mexico"
				,'estatus' => "Pendiente"
        	]);
		
    }
}
