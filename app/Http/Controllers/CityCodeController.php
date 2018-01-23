<?php

namespace App\Http\Controllers;

use App\CityCode;
use Illuminate\Http\Request;

class CityCodeController extends Controller
{
    public function searchCity(Request $request){
        $data = CityCode::where('country_id',$request->id)->orderBy('name','ASC')->get();
        return view('country.list_city',compact('data'));
    }

    public function autocomplete(Request $request){
        $data = CityCode::where('name','LIKE', '%'.$request->search.'%')
            ->orWhere('code_iata','LIKE', '%'.$request->search.'%')
            ->orderBy('name','ASC')
            ->get();
        return view('country.list_city',compact('data'));
    }

    public function searchCity_2(Request $request){
        $data = CityCode::where('country_id',$request->id)->orderBy('name','ASC')->get();
        return view('country.list_city_2',compact('data'));
    }

    public function autocomplete_2(Request $request){
        $data = CityCode::where('name','LIKE', '%'.$request->search.'%')
            ->orWhere('code_iata','LIKE', '%'.$request->search.'%')
            ->orderBy('name','ASC')
            ->get();
        return view('country.list_city_2',compact('data'));
    }
}
