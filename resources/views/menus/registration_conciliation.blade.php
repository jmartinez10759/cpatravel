@extends('template.dashboard-container')
@section('content')
<div class="container">
    <br><br>
    <div class="row" style="margin-top: 15%">
        <div class="col-md-12 col-sm-12 col-xs-6">
            <div class="about-item scrollpoint sp-effect2">

                <p style="text-align:center;">
                    Menú de Registros y Conciliación
                </p>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12 panel_menu">
            <div class="about-item scrollpoint sp-effect2">
                <p>
                    <a {{ checkPermission('click_me_etiquetas') ?  '' : 'href= '.route('label.index') }}>
                        <img src="{{ asset('images/menu/creacion_proyectos.png') }}" alt="">
                </p>
                <h3 class="font_menu">Etiquetas y Políticas de montos máximos.</h3>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-xs-12 panel_menu" >
            <div class="about-item scrollpoint sp-effect5">
                <p>
                    <img src="{{ asset('images/menu/autorisacion_comprobacion.png') }}" alt="">
                <h3 class="font_menu">Asientos contables</h3>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection