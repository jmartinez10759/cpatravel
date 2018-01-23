<?php

use Illuminate\Database\Seeder;
use App\Business;

class BusinessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        for($i=1;$i <= 10;$i++){
            Business::create([
                'name' => 'Empresa '.$i
            ]);

        }
    }
}
