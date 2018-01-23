<?php

namespace App\Http\Controllers;

use App\Country;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class ContryController extends Controller
{
    public function searchCountry(Request $request){
        $data = Country::where('name','LIKE', '%'.$request->search.'%')
                    ->orWhere('abbreviation','LIKE', '%'.$request->search.'%')
                    ->orderBy('name','DESC')
                    ->get();
        return view('country.list_country',compact('data'));
    }

    public function searchCountry_2(Request $request){
        $data = Country::where('name','LIKE', '%'.$request->search.'%')
                    ->orWhere('abbreviation','LIKE', '%'.$request->search.'%')
                    ->orderBy('name','DESC')
                    ->get();
        return view('country.list_country_2',compact('data'));
    }
}
