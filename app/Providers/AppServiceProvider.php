<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
use App\Tool;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Validator::extend('string_exist', function($attribute, $value, $parameters) {
           $cadena = Tool::RemplaceText(trim($value));
           $data = DB::table($parameters[0])->select('name')->where( DB::raw('REPLACE('.$parameters[1].', " ", "")') , $cadena)->first();
           return ($data)?  false : true;
        });


        Validator::extend('alpha_num_spaces', function($attribute, $value, $parameters)
        {
            return preg_match('/(^[A-Za-z0-9-ñÑáéíóúÁÉÍÓÚ ]+$)+/', $value);
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
