<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\SubProject;
use Illuminate\Http\Request;
use Validator;
class SubProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = SubProject::all();
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
        $val =Validator::make($request->all(),
            [
                'name'          => 'required|min:2|max:150|alpha_num_spaces|string_exist:sub_projects,name',
                'description'   => 'required|min:2|max:150|alpha_num_spaces',
                'project_id'    => 'required|integer',
                'business_id'   => 'required',
                'user_id'       => 'required'
            ]);
        if($val->fails()){
            return  response()->json(['error' => false,'errors' => $val->errors()]);
        }

        SubProject::create([
            'name'          =>  $request->name,
            'description'   =>  $request->description,
            'project_id'    =>  $request->project_id,
            'business_id'   =>  $request->business_id,
            'user_id'       =>  $request->user_id
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = SubProject::find($id);
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
