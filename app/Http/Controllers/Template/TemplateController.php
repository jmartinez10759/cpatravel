<?php

namespace App\Http\Controllers\Template;

use App\Http\Controllers\Apirest\MasterController;
use App\Http\Controllers\Apirest\ValidateTokenController;
use App\Http\Controllers\Apirest\ValidatePermissonController;

class TemplateController extends MasterController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function load_view( $view= false, $data= array(), $data_includes = array() ){
        return view($view,$data);
    }

    
}
