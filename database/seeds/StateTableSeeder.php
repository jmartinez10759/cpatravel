<?php

use Illuminate\Database\Seeder;
use App\State;

class StateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        State::create(['key' => 1,'name' => 'Aguascalientes','abbreviation' => 'Ags.', 'status' =>1]);
        State::create(['key' => 2,'name' => 'Baja California','abbreviation' => 'BC', 'status' =>1]);
        State::create(['key' => 3,'name' => 'Baja California Sur','abbreviation' => 'BCS', 'status' =>1]);
        State::create(['key' => 4,'name' => 'Campeche','abbreviation' => 'Camp.', 'status' =>1]);
        State::create(['key' => 5,'name' => 'Coahuila de Zaragoza','abbreviation' => 'Coah.', 'status' =>1]);
        State::create(['key' => 6,'name' => 'Colima','abbreviation' => 'Col.', 'status' =>1]);
        State::create(['key' => 7,'name' => 'Chiapas','abbreviation' => 'Chis.', 'status' =>1]);
        State::create(['key' => 8,'name' => 'Chihuahua','abbreviation' => 'Chih.', 'status' =>1]);
        State::create(['key' => 9,'name' => 'Distrito Federal','abbreviation' => 'DF', 'status' =>1]);
        State::create(['key' => 10,'name' => 'Durango','abbreviation' => 'Dgo.', 'status' =>1]);
        State::create(['key' => 11,'name' => 'Guanajuato','abbreviation' => 'Gto.', 'status' =>1]);
        State::create(['key' => 12,'name' => 'Guerrero','abbreviation' => 'Gro.', 'status' =>1]);
        State::create(['key' => 13,'name' => 'Hidalgo','abbreviation' => 'Hgo.', 'status' =>1]);
        State::create(['key' => 14,'name' => 'Jalisco','abbreviation' => 'Jal.', 'status' =>1]);
        State::create(['key' => 15,'name' => 'México','abbreviation' => 'Mex.', 'status' =>1]);
        State::create(['key' => 16,'name' => 'Michoacán de Ocampo','abbreviation' => 'Mich.', 'status' =>1]);
        State::create(['key' => 17,'name' => 'Morelos','abbreviation' => 'Mor.', 'status' =>1]);
        State::create(['key' => 18,'name' => 'Nayarit','abbreviation' => 'Nay.', 'status' =>1]);
        State::create(['key' => 19,'name' => 'Nuevo León','abbreviation' => 'NL', 'status' =>1]);
        State::create(['key' => 20,'name' => 'Oaxaca','abbreviation' => 'Oax.', 'status' =>1]);
        State::create(['key' => 21,'name' => 'Puebla','abbreviation' => 'Pue.', 'status' =>1]);
        State::create(['key' => 22,'name' => 'Querétaro','abbreviation' => 'Qro.', 'status' =>1]);
        State::create(['key' => 23,'name' => 'Quintana Roo','abbreviation' => 'Q. Roo', 'status' =>1]);
        State::create(['key' => 24,'name' => 'San Luis Potosí','abbreviation' => 'SLP', 'status' =>1]);
        State::create(['key' => 25,'name' => 'Sinaloa','abbreviation' => 'Sin.', 'status' =>1]);

    }
}
