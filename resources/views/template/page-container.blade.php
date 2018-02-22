@extends('template.dashboard')
@section('content')
<div class="container" id="content_general">
        <div class="row">

            <div class="col-sm-12 row-cont-info">
                <div  class="col-sm-2" id="sensor_edo_cta" onmouseleave="restaura()" onmouseover="destaca('home_boton_edo_cta')" onclick="openview('estadoscuenta')">
                </div>
                
                <div class="col-sm-2" id="sensor_proceso" onmouseleave="restaura()" onmouseover="destaca('home_boton_proceso')" onclick="openview('business/process')">
                </div>
                
                <div class="col-sm-2" id="sensor_politicas" onmouseleave="restaura()" onmouseover="destaca('home_boton_politicas')" onclick="openview('policies')">
                </div>

                <div class="col-sm-2" id="sensor_registros" onmouseleave="restaura()" onmouseover="destaca('home_boton_registros')" onclick="openview('registration/conciliation')">
                </div>
                <div class="col-sm-offset-1">
                    <img id="maincircle" src="images/circulo.png" class="circulo img-responsive center-block">
                </div>
            </div>

        </div>

        <!--Informacion de la aplicacion en forma de carrucel -->
        <div class="margen-slider cont-body" >
            <div id="carousel-example" class="carousel slide" data-ride="carousel">
                <!-- Wrapper for slides -->
                <div class="row">
                    <div class="col-sm-offset-2 col-sm-8">
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

<!--Se carga el script para la carga de los modales y sus respectivas vistas -->
<script type="text/javascript" src="{{ asset('js/page-container/page-container.js') }}"></script>

@endsection