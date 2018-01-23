<?php

use Illuminate\Database\Seeder;
use App\Country;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::create(['name' =>'España','abbreviation' => 'ES']);
        Country::create(['name' =>'Argentina','abbreviation' => 'AR']);
        Country::create(['name' =>'Países Bajos','abbreviation' => 'NL']);
        Country::create(['name' =>'Chile','abbreviation' => 'CL']);
        Country::create(['name' =>'Suecia','abbreviation' => 'SE']);
        Country::create(['name' =>'Paraguay','abbreviation' => 'PY']);
        Country::create(['name' =>'Grecia','abbreviation' => 'GR']);
        Country::create(['name' =>'Afganistán','abbreviation' => 'AF']);
        Country::create(['name' =>'Francia','abbreviation' => 'FR']);
        Country::create(['name' =>'Colombia','abbreviation' => 'CO']);
        Country::create(['name' =>'Hungría','abbreviation' => 'HU']);
        Country::create(['name' =>'Portugal','abbreviation' => 'PT']);
        Country::create(['name' =>'Venezuela','abbreviation' => 'VE']);
        Country::create(['name' =>'Marruecos','abbreviation' => 'MA']);
        Country::create(['name' =>'Cuba','abbreviation' => 'CU']);
        Country::create(['name' =>'Alemania','abbreviation' => 'DE']);
        Country::create(['name' =>'Estados Unidos','abbreviation' => 'US']);
        Country::create(['name' =>'Túnez','abbreviation' => 'TN']);
        Country::create(['name' =>'Rusia','abbreviation' => 'RU']);
        Country::create(['name' =>'Qatar','abbreviation' => 'QA']);
        Country::create(['name' =>'Emiratos Árabes Unidos','abbreviation' => 'AE']);
        Country::create(['name' =>'Reino Unido','abbreviation' => 'GB']);
        Country::create(['name' =>'Italia','abbreviation' => 'IT']);
        Country::create(['name' =>'Finlandia','abbreviation' => 'FI']);
        Country::create(['name' =>'China','abbreviation' => 'CN']);
        Country::create(['name' =>'Corea del Sur','abbreviation' => 'KR']);
        Country::create(['name' =>'Turquía','abbreviation' => 'TR']);
        Country::create(['name' =>'Bangladés','abbreviation' => 'BD']);
        Country::create(['name' =>'Islandia','abbreviation' => 'IS']);
        Country::create(['name' =>'Angola','abbreviation' => 'AO']);
        Country::create(['name' =>'Bélgica','abbreviation' => 'BE']);
        Country::create(['name' =>'Perú','abbreviation' => 'PE']);
        Country::create(['name' =>'Australia','abbreviation' => 'AU']);
        Country::create(['name' =>'Irlanda','abbreviation' => 'IE']);
        Country::create(['name' =>'Mauricio','abbreviation' => 'MRU']);
        Country::create(['name' =>'Rumania','abbreviation' => 'RO']);
        Country::create(['name' =>'Singapur','abbreviation' => 'SG']);
        Country::create(['name' =>'Israel','abbreviation' => 'IL']);
        Country::create(['name' =>'Taiwán','abbreviation' => 'TW']);
        Country::create(['name' =>'Kazajistán','abbreviation' => 'TSE']);
        Country::create(['name' =>'Ecuador','abbreviation' => 'EC']);
        Country::create(['name' =>'Austria','abbreviation' => 'AT']);
        Country::create(['name' =>'Nueva Zelanda','abbreviation' => 'NZ']);
        Country::create(['name' =>'Canadá','abbreviation' => 'CA']);
        Country::create(['name' =>'Croacia','abbreviation' => 'HR']);
        Country::create(['name' =>'México','abbreviation' => 'MX']);
    }
}
