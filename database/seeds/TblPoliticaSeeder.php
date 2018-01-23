<?php

use Illuminate\Database\Seeder;
use App\Model\Apirest\TblPolitica;

class TblPoliticaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        for ($i=1; $i <= 9; $i++) {

             TblPolitica::create([
                'importe_ded_nal'               => 0
                ,'importe_ded_ext'              => 0
                ,'importe_emp_nal'              => 0
                ,'importe_emp_ext'              => 0
                ,'status'                       => 1
                ,'id_usuario'                   => 27391
                ,'id_empresa'                   => 11613
                ,'id_proyecto'                  => 1
                ,'id_subproyecto'               => 1
                ,'id_viaje'                     => 1
                ,'tipo'                         => 'predeterminadas'
                ,'id_etiqueta'                  => $i
            ]);
            
        }


    }
}
