@extends('layouts.app')
@section('content')
    <div class="container">
        <br><br>
        <div class="row" style="margin-top: 15%">
            <div class="col-md-12 col-sm-12 col-xs-6">
                <div class="about-item scrollpoint sp-effect2">

                    <p style="text-align:center;">
                        Menu de Politicas
                    </p>
                </div><! --/about-item -->
            </div><! --/col-md-3 -->
        </div>
        <br>
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-6 panel_menu">
                <div class="about-item scrollpoint sp-effect2">
                    <p>
                        <a {{ checkPermission('click_me_etiquetas') ?  '' : 'href= '.route('label.index') }}>
                            <img src="{{ asset('images/menu/creacion_proyectos.png') }}" alt="">
                        </a>
                    </p>
                    <h3 class="font_menu">Etiquetas y Políticas de montos máximos.</h3>
                </div><! --/about-item -->
            </div><! --/col-md-3 -->

            <div class="col-md-4 col-sm-4 col-xs-6 panel_menu" >
                <div class="about-item scrollpoint sp-effect5">
                    <p>
                        <a {{ checkPermission('click_me_aut_viaje') ?  '' : 'href= '.route('travel_autho') }}>
                            <img src="{{ asset('images/menu/autorizacion_viaje.png') }}" alt="">
                        </a>
                    </p>
                    <h3 class="font_menu">Definir cobro de gastos no comprobados</h3>
                </div><! --/about-item -->
            </div><! --/col-md-3 -->

            <div class="col-md-4 col-sm-4 col-xs-6 panel_menu" >
                <div class="about-item scrollpoint sp-effect5">
                    <p>
                        <img src="{{ asset('images/menu/autorisacion_comprobacion.png') }}" alt="">
                    <h3 class="font_menu">Asientos contables</h3>
                    </p>
                </div><! --/about-item -->
            </div><! --/col-md-3 -->


        </div><! --/row -->
    </div>

@endsection



