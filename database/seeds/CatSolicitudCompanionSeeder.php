<?php

use Illuminate\Database\Seeder;
use App\ModelWeb\CatSolicitudCompanion;

class CatSolicitudCompanionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for ($i=1; $i <= 3; $i++) { 

	        CatSolicitudCompanion::create([
		    	'id_solicitud' 		=> 		$i
		        ,'id_empresa' 		=> 		11613
	    		,'id_usuario' 		=> 		27391
		        ,'status' 			=> 		1
	        ]);

    	}


    }
}
