<?php

use Illuminate\Database\Seeder;
use App\Label;
use App\Travel;
use App\Project;
use App\SubProject;
use Faker\Factory as Faker;

class LabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Label::create([
            'iden'                                  => sha1('Alimentación'),
            'name'                                  => 'Alimentación',
            'description'                           => 'Etiqueta descripcion Alimentación',
            'national_maximum_deductible_amount'    =>  750.00,
            'foreign_maximum_deductible_amount'     =>  1500.00,
            'national_company_policies'             =>  500.00,
            'foreign_company_policies'              =>  500.99,
            'business_id'                           =>  1,
            'user_id'                               =>  "af342f96-9425-44c2-bdde-78b9d00b131e"
        ]);

        Label::create([
            'iden'                                  => sha1('Hospedaje'),
            'name'                                  => 'Hospedaje',
            'description'                           => 'Etiqueta descripcion Hospedaje',
            'national_maximum_deductible_amount'    =>  00.00,
            'foreign_maximum_deductible_amount'     =>  3850.00,
            'national_company_policies'             =>  500.00,
            'foreign_company_policies'              =>  500.99,
            'business_id'                           =>  1,
            'user_id'                               =>  "af342f96-9425-44c2-bdde-78b9d00b131e"
        ]);

        Label::create([
            'iden'                                  => sha1('Transporte'),
            'name'                                  => 'Transporte',
            'description'                           => 'Etiqueta descripcion Transporte',
            'national_maximum_deductible_amount'    =>  00.00,
            'foreign_maximum_deductible_amount'     =>  00.00,
            'national_company_policies'             =>  500.00,
            'foreign_company_policies'              =>  500.99,
            'business_id'                           =>  1,
            'user_id'                               =>  "af342f96-9425-44c2-bdde-78b9d00b131e"
        ]);

        Label::create([
            'iden'                                  => sha1('Renta de Autos'),
            'name'                                  => 'Renta de Autos',
            'description'                           => 'Etiqueta descripcion Renta de Autos',
            'national_maximum_deductible_amount'    =>  850.00,
            'foreign_maximum_deductible_amount'     =>  850.00,
            'national_company_policies'             =>  500.00,
            'foreign_company_policies'              =>  500.99,
            'business_id'                           =>  1,
            'user_id'                               =>  "af342f96-9425-44c2-bdde-78b9d00b131e"
        ]);

        Label::create([
            'iden'                                  => sha1('Seminarios o Convenciones'),
            'name'                                  => 'Seminarios o Convenciones',
            'description'                           => 'Etiqueta descripcion Seminarios o Convenciones',
            'national_maximum_deductible_amount'    =>  750.00,
            'foreign_maximum_deductible_amount'     =>  1500.00,
            'national_company_policies'             =>  500.00,
            'foreign_company_policies'              =>  600.99,
            'business_id'                           =>  1,
            'user_id'                               =>  "af342f96-9425-44c2-bdde-78b9d00b131e"
        ]);

        Label::create([
            'iden'                                  => sha1('Pago por kilometraje'),
            'name'                                  => 'Pago por kilometraje',
            'description'                           => 'Etiqueta descripcion Pago por kilometraje',
            'national_maximum_deductible_amount'    =>  00.00,
            'foreign_maximum_deductible_amount'     =>  00.00,
            'national_company_policies'             =>  1500.00,
            'foreign_company_policies'              =>  1500.99,
            'business_id'                           =>  1,
            'user_id'                               =>  "af342f96-9425-44c2-bdde-78b9d00b131e"
        ]);

        Label::create([
            'iden'                                  => sha1('Transporte aéreo'),
            'name'                                  => 'Renta de Transporte aéreo',
            'description'                           => 'Etiqueta descripcion Transporte aéreo',
            'national_maximum_deductible_amount'    =>  12.00,
            'foreign_maximum_deductible_amount'     =>  45.00,
            'national_company_policies'             =>  1500.00,
            'foreign_company_policies'              =>  1500.99,
            'business_id'                           =>  1,
            'user_id'                               =>  "af342f96-9425-44c2-bdde-78b9d00b131e"
        ]);

        Label::create([
            'iden'                                  => sha1('Transporte terrestre'),
            'name'                                  => 'Renta de Transporte terrestre',
            'description'                           => 'Etiqueta descripcion Transporte terrestre',
            'national_maximum_deductible_amount'    =>  100.00,
            'foreign_maximum_deductible_amount'     =>  100.00,
            'national_company_policies'             =>  1500.00,
            'foreign_company_policies'              =>  1500.99,
            'business_id'                           =>  1,
            'user_id'                               =>  "af342f96-9425-44c2-bdde-78b9d00b131e"
        ]);
        $faker = Faker::create();
        $counProject = count(Project::all());
        $counSubProject = count(SubProject::all());
        $counTravel = count(Travel::all());

        /*
        for($i=1;$i <= ENV('NUM_FOR');$i++){
            $labelCorpo="Label Corporativa ".$i;
            Label::create([
                'iden'                                  =>  sha1($labelCorpo),
                'name'                                  =>  $labelCorpo,
                'description'                           =>  'descripcion ',
                'national_maximum_deductible_amount'    =>  100,
                'foreign_maximum_deductible_amount'     =>  90.9,
                'national_company_policies'             =>  89.9,
                'foreign_company_policies'              =>  100,
                'user_id'                               =>  "af342f96-9425-44c2-bdde-78b9d00b131e",
                'business_id'                           =>  $faker->randomElement($array = [
                                                            '4ea72fcf-f158-4fc5-aa1b-aebd04a2c9f1',
                                                            '60054e5c-c8ce-421b-9b0c-fafc50ece671',
                                                            '9209']),
                'project_id'                            =>  $faker->numberBetween(1,$counProject),
                'sub_project_id'                        =>  $faker->numberBetween(1,$counSubProject),
                'travel_id'                             =>  $faker->numberBetween(1,$counTravel),
                'type_label'                            =>  'corporativas'
            ]);
        }


        for($i=1;$i <= ENV('NUM_FOR');$i++){
            $labelCorpo="Label personalizadas ".$i;
            Label::create([
                'iden'                                  =>  sha1($labelCorpo),
                'name'                                  =>  $labelCorpo,
                'description'                           =>  'descripcion ',
                'national_maximum_deductible_amount'    =>  100,
                'foreign_maximum_deductible_amount'     =>  90.9,
                'national_company_policies'             =>  89.9,
                'foreign_company_policies'              =>  100,
                'user_id'                               =>  "af342f96-9425-44c2-bdde-78b9d00b131e",
                'business_id'                           =>  $faker->randomElement($array = [
                    '4ea72fcf-f158-4fc5-aa1b-aebd04a2c9f1',
                    '60054e5c-c8ce-421b-9b0c-fafc50ece671',
                    '9209']),
                'project_id'                            =>  $faker->numberBetween(1,$counProject),
                'sub_project_id'                        =>  $faker->numberBetween(1,$counSubProject),
                'travel_id'                             =>  $faker->numberBetween(1,$counTravel),
                'type_label'                            =>  'usuario'
            ]);
        }

        */

        //type_label


    }
}
