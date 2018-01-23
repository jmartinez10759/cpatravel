<?php

use Illuminate\Database\Seeder;
use App\TblSubProyecto;

class TblSubProyectosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          TblSubProyecto::create([
    			'id_proyecto' => 1
    			,'nombre' => "Eventos de Santander"
    			,'sub_proyecto' => "Describe el evento de santander"
        	]);
    }
}
