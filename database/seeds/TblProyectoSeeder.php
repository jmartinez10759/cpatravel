<?php

use Illuminate\Database\Seeder;
use App\TblProyecto;

class TblProyectoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         TblProyecto::create([
    			'id_empresa'  => 11613
    			,'nombre' 	  => 'Bancomer'
    			,'proyecto'   => 'Descripcion del proyecto de bancomer'
        	]);
    }
}
