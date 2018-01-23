<!-- submenus de bussness process -->
<!-- App\Http\Controllers\RoutingController@businessProcess -->
@extends('template.dashboard-container')
@section('content')
<div class="container">
    <br><br>
    <input type="hidden" id="return" value="{{ $return }}">
    <div class="row" style="margin-top: 15%">
        <div class="col-sm-12">
            <div class="about-item scrollpoint sp-effect2">
                <p style="text-align:center;">
                    <img src="{{ asset('images/menu/proceso_negocio.png') }}" alt="proceso_negocio">
                </p>
            </div> 
        </div>
    </div>
    <br>
    <div class="row">

        <div class="col-sm-3 panel_menu">
            <div class="about-item scrollpoint sp-effect2">
                <p>
                    <div  url="{{ route('create_project') }}" onclick="load_views(this)" style="cursor: pointer;">
                        <img src="{{ asset('images/menu/creacion_proyectos.png') }}" alt="">
                    </div>
                </p>
                <h3 class="font_menu">{{$titulo1}}</h3>
            </div>
        </div>

        <div class="col-sm-3 panel_menu" >
            <div class="about-item scrollpoint sp-effect5">
                <p>

                    <div  url="{{ route('authorization_travel') }}" onclick="carga_vista_html('authorization','business/process')" style="cursor: pointer;">
                        <img src="{{ asset('images/menu/autorizacion_viaje.png') }}" alt="">
                    </div>
                </p>
                <h3 class="font_menu">{{$titulo2}}</h3>
            </div>
        </div>

        <div class="col-sm-3 panel_menu" >
            <div class="about-item scrollpoint sp-effect5">
                <p>
                    <img src="{{ asset('images/menu/autorisacion_comprobacion.png') }}" alt="">
                    
                <h3 class="font_menu">{{$titulo3}}</h3>
                </p>
            </div>
        </div>

        <div class="col-sm-3 panel_menu" >
            <div class="about-item scrollpoint sp-effect1">

                <p>
                    <div href="{{ route('pending') }}" onclick="carga_vista_html('pending','business/process')" style="cursor: pointer;">
                        <img src="{{ asset('images/menu/autorizacion_pendientes.png') }}" alt="">
                    </div>
                </p>
                <h3 class="font_menu">{{$titulo4}}</h3>
            </div>
        </div>
        
    </div>
</div>
@endsection