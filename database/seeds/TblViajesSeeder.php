<?php

use Illuminate\Database\Seeder;
use App\TblViaje;

class TblViajesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         TblViaje::create([
    			'id_proyecto' => 1
    			,'id_subproyecto' => 1
    			,'nombre' => "Veracruz"
    			,'viaje' => "Estado de veracruz"
        	]);
    }
}
