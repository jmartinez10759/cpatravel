<?php

namespace App\Http\Controllers;

use App\SubProject;
use Session;
use Illuminate\Http\Request;

class SubProjectExtendController extends Controller
{
    public function searchSubProject(Request $request){
        //dd($request->all());
        $data = SubProject::where("name","LIKE","%{$request->input('query')}%")
            ->where('business_id',Session::get('business_id'))
            ->where('project_id',$request->project_id)
            ->take(ENV('NUM_LIMIT'))->get();
        return response()->json($data);
    }

    public function searchSubProjectAccount(Request $request){
        $data = SubProject::where("name","LIKE","%{$request->input('query')}%")
            ->where('business_id',Session::get('business_id'))
            ->take(ENV('NUM_LIMIT'))->get();
        $array = [];
        $i = 0;
        foreach ($data  as $d){
            $array[$i]['id'] = $d->id;
            $array[$i]['name']=$d->name;
            $array[$i]['description']=$d->description;
            $array[$i]['project_id']=$d->project_id;
            $array[$i]['active']=$d->active;
            $array[$i]['business_id']=$d->business_id;
            $array[$i]['user_id']=$d->user_id;
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
