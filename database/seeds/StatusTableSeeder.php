<?php

use Illuminate\Database\Seeder;
use App\Statu;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Statu::create([
            'name' => 'Borrardor'
        ]);

        Statu::create([
            'name' => 'Proceso'
        ]);

        Statu::create([
            'name' => 'Autorizado'
        ]);

        Statu::create([
            'name' => 'Rechazado'
        ]);
    }
}
