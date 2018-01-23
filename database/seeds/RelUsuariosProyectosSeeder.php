<?php

use Illuminate\Database\Seeder;
use App\RelUsuarioProyecto;

class RelUsuariosProyectosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RelUsuarioProyecto::create([
		        'id_usuario' => 27391
		    	,'id_proyecto' => 1
		    	,'id_subproyecto' => 1
		    	,'id_viaje' => 1
        	]);
    }
}
