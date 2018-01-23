<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Business;
use Faker\Factory as Faker;
use App\Businessrelation;

class BusinessRelationTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $faker = Faker::create();

        $countUser = count( User::all());
        $countBusiness = count(Business::all());
        for($i=0; $i <= 20; $i++){

            //print_r($i .'<br>');
            Businessrelation::create([
                'user_id'       => $faker->numberBetween(1,$countUser),
                'business_id'   => $faker->numberBetween(1,$countBusiness)
            ]);
        }
        //dd(' Los usuarios son '. $countUser);
    }
}
