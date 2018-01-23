<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LabelExtendController extends Controller
{
    public function detail(){
        return view('labels.detail_view');
    }
}
