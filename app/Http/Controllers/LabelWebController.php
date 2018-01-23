<?php

namespace App\Http\Controllers;

use App\Label;
use Illuminate\Http\Request;
use Session;

class LabelWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(checkPermission('click_me_etiquetas')){
            dd('aborte');
        }
        $dataLabel = Label::where('type_label', 'predeterminadas')->get();
        $dataLabelCorporativas = Label::where('type_label','corporativas')->where('business_id',Session::get('business_id'))->get();
        $dataLabelPersonalizadas = Label::where('type_label','personalizadas')->where('business_id',Session::get('business_id'))->get();
        return view('labels.index',compact('dataLabel','dataLabelCorporativas','dataLabelPersonalizadas'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function show(Label $label)
    {
        return view('labels.detail',compact('label'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function edit(Label $label)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Label $label)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function destroy(Label $label)
    {
        //
    }
}
