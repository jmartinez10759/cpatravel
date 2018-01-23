<?php

use Illuminate\Database\Seeder;
use App\ModelWeb\CatViaticoDetalle;

class CatViaticosDetallesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CatViaticoDetalle::create([
        	'id_viatico' 				=> 1
    		,'id_solicitud' 			=> 1
	    	,'id_empresa' 				=> 11613
	    	,'id_usuario' 				=> 27391
	    	,'viatico_cantidad' 		=> 2
	    	,'viatico_unidad' 			=> 1
	    	,'viatico_costo_unitario' 	=> 1000.00
	    	,'status'					=> 1
        ]);

        CatViaticoDetalle::create([
        	'id_viatico' 				=> 2
    		,'id_solicitud' 			=> 1
	    	,'id_empresa' 				=> 11613
	    	,'id_usuario' 				=> 27391
	    	,'viatico_cantidad' 		=> 2
	    	,'viatico_unidad' 			=> 1
	    	,'viatico_costo_unitario' 	=> 2000.00
	    	,'status'					=> 1
        ]);


    }
}
