<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\SubProject;
use App\Travel;

class ProjectExtendController extends ProjectController
{
    public function projects(){
        $array= [];
        $data = Project::orderBy('id', 'desc')->get();
        $i=0;
        foreach ($data as $dat) {
            $array[$i]['project']['id'] = $dat['id'];
            $array[$i]['project']['name'] = $dat['name'];
            $dataSub = SubProject::where('project_id',$dat['id'])->get();
            $i2=0;
            $array[$i]['subproject'] = [];
            $array[$i]['travel'] = [];
            foreach ($dataSub as $dats){
                $array[$i]['subproject'][$i2]['id'] = $dats['id'];
                $array[$i]['subproject'][$i2]['name'] = $dats['name'];
                $travel = Travel::where('sub_project_id',$dats['id'])->get();
                $i3=0;
                foreach($travel as $datr){
                    $array[$i]['travel'][$i3]['id'] = $datr['id'];
                    $array[$i]['travel'][$i3]['name'] = $datr['name'];
                    $i3++;
                }
                $i2++;
            }
            $i++;
        }
        return response()->json(['success' => true,'data' => $array]);
    }

}
