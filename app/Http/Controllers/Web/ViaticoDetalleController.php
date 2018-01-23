<?php

namespace App\Http\Controllers\Web;

use Session;
use App\Label;
use App\Country;
use App\StatusAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\Web\MasterWebController;

class ViaticoDetalleController extends MasterWebController
{
    private $_permits;
    
    public function __construct(){
        parent::__construct();
        $this->_permits=  self::verify_permison();
    }
}
