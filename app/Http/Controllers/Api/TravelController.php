<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Travel;
use Validator;

class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Travel::all();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name'          => 'required|min:2|max:150|alpha_num_spaces|string_exist:travels,name',
            'description'   => 'required|min:2|max:150|alpha_num_spaces',
            'project_id'    => 'required|integer',
            'business_id'   => 'required|integer',
        ];

        $shortName = $request->short_name;
        if(trim($shortName) == ''){
            $shortName = $request->name;
        }else{
            $rules += ['short_name'  =>  'min:2|max:150'];
        }

        $val =Validator::make($request->all(),$rules);
        if($val->fails()){
            return  response()->json(['error' => false,'errors' => $val->errors()]);
        }
        $data = Travel::create([
            'name'          =>  $request->name,
            'description'   =>  $request->description,
            'project_id'    =>  $request->project_id,
            'sub_project_id'=>  $request->sub_project_id,
            'business_id'   =>  $request->business_id,
            'user_id'       =>  $request->user_id,
            'label'    =>  $shortName
        ]);

        return response()->json(['success' => true ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Travel::find($id);
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
