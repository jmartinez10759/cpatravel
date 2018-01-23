<?php

use Illuminate\Database\Seeder;
use App\ModelWeb\CatSolicitudMonto;

class CatSolicitudMontoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CatSolicitudMonto::create([
	    	'id_solicitud'					=> 1
	    	,'id_viatico'					=> 1
	    	,'id_empresa' 					=> 11613
	    	,'id_usuario' 					=> 27391
	    	,'monto_tipo_solicitud'			=> "Nacional"
	    	,'monto_tipo_pago'				=> "Efectivo"
	    	,'monto_importe'				=> 500
	    	,'monto_importe_autorizado'		=> 10000
	    	,'status'						=>  1 
        ]);

        CatSolicitudMonto::create([
	    	'id_solicitud'					=> 1
	    	,'id_viatico'					=> 1
	    	,'id_empresa' 					=> 11613
	    	,'id_usuario' 					=> 27391
	    	,'monto_tipo_solicitud'			=> "Nacional"
	    	,'monto_tipo_pago'				=> "TDC"
	    	,'monto_importe'				=> 200
	    	,'monto_importe_autorizado'		=> 10000
	    	,'status'						=>  1 
        ]);

    }
}
