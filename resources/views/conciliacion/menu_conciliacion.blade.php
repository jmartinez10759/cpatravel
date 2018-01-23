@extends('template.dashboard-container')
@section('content')
    <div class="container">
        <br><br>
        <div class="row titulo-pantalla">
            <div class="col-xs-12 col-sm-12 col-md-12 "><span class="icon-tit_solicitud icon-tam2"></span> 
                Menú de Registros y Conciliación
            </div>
        </div>
        <br><br><br>
        <div class="row">
            <div class="col-sm-6 panel_menu">
                <div class="about-item scrollpoint sp-effect2">
                        <div style="cursor: pointer;" onclick="carga_vista_html('')">
                            <img src="{{ asset('images/menu/creacion_proyectos.png') }}" alt="">
                        </div>
                    <h3 class="font_menu">{{ $titulo1 }}</h3>
                </div>
            </div>

            <div class="col-sm-6  panel_menu" >
                <div class="about-item scrollpoint sp-effect5">
                        <div style="cursor: pointer;" onclick="carga_vista_html('')">
                            <img src="{{ asset('images/menu/autorisacion_comprobacion.png') }}" alt="">
                        </div>
                    <h3 class="font_menu">{{ $titulo2 }}</h3>
                </div>
            </div>

        </div>
    </div>

@endsection



