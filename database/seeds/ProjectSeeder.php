<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();


        for($i=1;$i <= ENV('NUM_FOR',20);$i++){
            Project::create([
                'name'          =>  'Nombre del proyecto'.$i,
                'description'   =>  'Descripción proyecto '.$i,
                'business_id'   =>  '4ea72fcf-f158-4fc5-aa1b-aebd04a2c9f1',
                'active'        =>  0,
                'user_id'       =>  "af342f96-9425-44c2-bdde-78b9d00b131e"
            ]);
        }
    }
}
