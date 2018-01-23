<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Label;

class SolicitudeController extends Controller
{
    public function lodging($iden){
        $label = Label::find($iden);
        return view('solicitud.label_hospedaje',compact('label'));
    }

    public function foot($iden){
        $label = Label::find($iden);
        return view('solicitud.label_comidas',compact('label'));
    }

    public function taxi($iden){
        $label = Label::find($iden);
        return view('solicitud.label_taxi',compact('label'));
    }

    public function mileage($iden){
        $label = Label::find($iden);
        return view('solicitud.label_kilometraje',compact('label'));
    }

    public function rentCar($iden){
        $label = Label::find($iden);
        return view('solicitud.label_renta_carro',compact('label'));
    }

    public function groundTransportation($iden){
        $label = Label::find($iden);
        return view('solicitud.label_transporte_terrestre',compact('label'));
    }

    public function conference($iden){
        $label = Label::find($iden);
        return view('solicitud.label_seminarios',compact('label'));
    }

    public function airplane($iden){
        $label = Label::find($iden);
        return view('solicitud.label_transporte_aereo',compact('label'));
    }







}
