<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\SubProject;
use App\Travel;
use Illuminate\Support\Facades\Session;
use Log;

class ProjectExtendController extends Controller
{
    public function list_project(){
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
        return view('list_project',['data' => $array]);
    }

    public function search(Request $request){
        $data = Travel::where("name","LIKE","%$request->search%")
            ->orWhere("short_name","LIKE","%$request->search%")->get();
        $i=0;
        $array =[];
        foreach ($data as $dat) {


            $dataProject= Project::find($dat['project_id']);
            $array[$i]['project']['id'] = $dataProject->id;
            $array[$i]['project']['name'] = $dataProject->name;

            $dataSub = SubProject::find($dat['sub_project_id']);
            Log::error('son registros'. count($dataSub));

            $array[$i]['subproject']['id'] = $dataSub->id;
            $array[$i]['subproject']['name'] = $dataSub->name;
            $array[$i]['travel']['name'] = $dat['name'];
            $array[$i]['travel']['id'] = $dat['id'];

            /*
            $dataSub = SubProject::find($dat['sub_project_id']);
            Log::error($dataSub);
            $i2=0;
            $array[$i]['subproject'] = [];
            $array[$i]['travel'] = [];
            foreach ($dataSub as $dats){
                Log::error($dats);
                $array[$i]['subproject'][$i2]['id'] = $dats['id'];
                $array[$i]['subproject'][$i2]['name'] = $dats['name'];

                $travel = Travel::where('sub_project_id',$dats['id'])->get();
                $i3=0;
                foreach($travel as $datr){
                    $array[$i]['travel'][$i3]['id'] = $dat['id'];
                    $array[$i]['travel'][$i3]['name'] = $dat['name'];
                    $i3++;
                }
                $i2++;
            }
            */
            $i++;
        }
        return view('list_project_travel',['data' => $array]);
    }

    public function searchProject(Request $request){
        $data = Project::where("name","LIKE","%{$request->input('query')}%")
            ->where('business_id',Session::get('business_id'))
            ->take(ENV('NUM_LIMIT'))->get();
        return response()->json($data);
    }

    public function searchProjectAccount(Request $request){
        $data = Project::where("name","LIKE","%{$request->input('query')}%")
            ->where('business_id',Session::get('business_id'))
            ->take(ENV('NUM_LIMIT'))->get();
        return response()->json($data);
    }
}
