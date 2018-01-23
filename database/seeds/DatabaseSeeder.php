<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        #$this->call(UsersTableSeeder::class);
        $this->call(ProjectSeeder::class);
        $this->call(SubprojectSeeder::class);
        $this->call(TravelSeeder::class);
        $this->call(LabelSeeder::class);
        $this->call(cityCodeTableSeeder::class);
        $this->call(StateTableSeeder::class);
        $this->call(MunicipalitieTableSeeder::class);
        $this->call(CountryTableSeeder::class);
        $this->call(StatusTableSeeder::class);
        $this->call(SeederStatusAccountTable::class);
        
    #se mandan a llamar las tablas actualizadas 2017-11-16 @author Jorge Martinez Quezada 
        $this->call(TblProyectoSeeder::class);
        $this->call(TblSubProyectosSeeder::class);
        $this->call(TblViajesSeeder::class);
        $this->call(RelUsuariosProyectosSeeder::class);
    }
}
