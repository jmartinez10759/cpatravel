@extends('template.dashboard')
@section('content')

        <input type="hidden" id="id_usuario" value="{{ $id_usuario }}">
        <input type="hidden" id="token" value="{{ $token }}">
        <div class="container">
            <div class="row">
                <div class="container">

                    <div class="row">
                        <div class="col-sm-12 row-cont-info">
                            <div  class="col-sm-2" id="sensor_edo_cta" url="{{route('account_status')}}" onmouseleave="restaura()" onmouseover="destaca('home_boton_edo_cta')" onclick="openview(this)">
                            </div>
                            
                            <div class="col-sm-2" id="sensor_proceso" url="{{route('business_process')}}" onmouseleave="restaura()" onmouseover="destaca('home_boton_proceso')" onclick="openview(this)">
                            </div>
                            
                            <div class="col-sm-2" id="sensor_politicas" url="{{route('policies')}}" onmouseleave="restaura()" onmouseover="destaca('home_boton_politicas')" onclick="openview(this)">
                            </div>

                            <div class="col-sm-2" id="sensor_registros" url="{{route('registration_conciliation')}}" onmouseleave="restaura()" onmouseover="destaca('home_boton_registros')" onclick="openview(this)">
                            </div>
                            <div class="col-sm-offset-1">
                                <img id="maincircle" src="images/circulo.png" class="circulo img-responsive center-block">
                            </div>
                        </div>
                    </div>

                </div>
<!--Informacion de la aplicacion en forma de carrucel -->
                <div class="container margen-slider cont-body">
                    <div id="carousel-example" class="carousel slide" data-ride="carousel">
                        <!-- Wrapper for slides -->
                        <div class="row">
                            <div class="col-sm-offset-3 col-sm-7">
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <div class="carousel-content">
                                            <div>
                                                <h3 class="welcome_title">{{ $titulo }}</h3>
                                                <p class="welcome_paragrph">{{$descripcion1}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="carousel-content">
                                            <div>
                                                <h3 class="welcome_title">{{ $titulo }}</h3>
                                                <p class="welcome_paragrph">{{$descripcion2}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="carousel-content">
                                            <div>
                                                <h3 class="welcome_title">{{ $titulo }}</h3>
                                                <p class="welcome_paragrph">{{$descripcion3}}</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example" data-slide="prev">
                            <span><img src="{{ asset('images/slider_flecha_izq.png') }}"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example" data-slide="next">
                            <span> <img src="{{ asset('images/slider_flecha_der.png') }}"></span>
                        </a>
                    </div>
                </div>

                </div>
        </div>
<!--Se crea la vista del div correspondiente-->
<div id="content-view" style="display: none" class="container">
    <br><br>
    <div class="pull-right col-sm-2">
        <button class="btn btn-default" url="" type="button" onclick="hideview(this)">Cerrar Ventana</button>
    </div>
    <div class="pull-left col-sm-1">
        <button class="btn btn-default" id="button_back_general" type="button" onclick="back_button(this)">Regresar</button>
    </div>
    <div id="container-views" class="container"></div>
    <br>
    <!-- Loader -->
        <div class="col-sm-12" id="loader-msj" style="display: none;">
            <center>
                <h3>Cargando, favor de esperar....<h3>
                <div id="div-loader" class="loader" style="display:block;"></div>           
            </center>
        </div>
<!--end Loader  -->

</div>


<!--Se carga el script para la carga de los modales y sus respectivas vistas -->
<script type="text/javascript" src="{{ asset('js/page-container/page-container.js') }}"></script>


@endsection