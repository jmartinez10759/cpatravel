<?php

use Illuminate\Database\Seeder;
use App\StatusAccount;

class SeederStatusAccountTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusAccount::create([
            'name' => 'Solicitando CFDI'
        ]);

        StatusAccount::create([
            'name' => 'CFDI en búsqueda'
        ]);

        StatusAccount::create([
            'name' => 'CFDI encontrado'
        ]);

        StatusAccount::create([
            'name' => 'Anticipo'
        ]);

        StatusAccount::create([
            'name' => 'Comprobables'
        ]);

        StatusAccount::create([
            'name' => 'No comprobables'
        ]);

        StatusAccount::create([
            'name' => 'Recepción de transferencia'
        ]);

        StatusAccount::create([
            'name' => 'Transferencia de saldo'
        ]);
    }
}
