<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Travel;
use Session;

class TravelExtendController extends Controller
{
    public function searchTravel(Request $request){

        $data = Travel::where("name","LIKE","%{$request->input('query')}%")
            ->where('project_id',$request->project_id)
            ->where('sub_project_id',$request->subproject_id)
            ->where('business_id',Session::get('business_id'))
            ->orWhere("label","LIKE","%{$request->input('query')}%")
            ->take(ENV('NUM_LIMIT'))->get();
        return response()->json($data);
    }

    public function searchTravelAccount(Request $request){
        $data = Travel::where("name","LIKE","%{$request->input('query')}%")
            ->orWhere("label","LIKE","%{$request->input('query')}%")
            ->take(ENV('NUM_LIMIT'))->get();
        $array = [];
        $i = 0;
        foreach ($data  as $d){
            //dd($d->subproject->id);
            $array[$i]['id'] = $d['id'];
            $array[$i]['name'] = $d['name'];
            $array[$i]['description']= $d['description'];
            $array[$i]['project_id']= $d['project_id'];
            $array[$i]['sub_project_id']= $d['sub_project_id'];
            $array[$i]['active']= $d['active'];
            $array[$i]['business_id']= $d['business_id'];
            $array[$i]['label']= $d['label'];
            $array[$i]['user_id']= $d['user_id'];
            $array[$i]['business_id']= $d['business_id'];
            $array[$i]['subproyecto']= [];
            $array[$i]['subproyecto']['id'] = $d->subproject->id;
            $array[$i]['subproyecto']['name']=$d->subproject->name;
            $array[$i]['subproyecto']['description']=$d->subproject->description;
            $array[$i]['subproyecto']['project_id']=$d->subproject->project_id;
            $array[$i]['subproyecto']['active']=$d->subproject->active;
            $array[$i]['subproyecto']['business_id']=$d->subproject->business_id;
            $array[$i]['subproyecto']['user_id']=$d->subproject->user_id;
            $array[$i]['proyecto']= [];
            $array[$i]['proyecto']['id'] = $d->project->id;
            $array[$i]['proyecto']['name']= $d->project->name;
            $array[$i]['proyecto']['description']= $d->project->description;
            $array[$i]['proyecto']['active']= $d->project->active;
            $array[$i]['proyecto']['business_id']= $d->project->business_id;
            $array[$i]['proyecto']['user_id']= $d->project->user_id;
            $i++;
        }
        return response()->json($array);
    }
}
