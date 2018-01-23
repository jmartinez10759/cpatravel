@extends('layouts.app')
@section('nav')
@include('layouts.nav')
@endsection
@section('content')
     <!-- <div id="blur"> -->
        <div class="container">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 row-cont-info">
                            <div {{ checkPermission('click_me_est_cuenta') ? '' : 'onclick=openIframe("'.route("account_status").'"); id = sensor_edo_cta onmouseover = destaca("home_boton_edo_cta"); onmouseleave=restaura();'  }} ></div>
                            <img id="maincircle" src="images/circulo.png" class="circulo img-responsive center-block">
                            <div {{ checkPermission('click_me_pro_negocios') ? '' : 'onclick=openIframe("'.route("business_process").'"); id = sensor_proceso onmouseover = destaca("home_boton_proceso"); onmouseleave=restaura();'   }}  ></div>
                            <div {{ checkPermission('click_me_politicas') ? '' : ' onclick=openIframe("'.route("policies").'"); id = sensor_politicas onmouseover = destaca("home_boton_politicas"); onmouseleave=restaura();'  }}></div>
                            <div {{ checkPermission('click_me_reg_conciliacion') ? '' : 'onclick=openIframe("'.route("registration_conciliation").'");  id=sensor_registros onmouseover=destaca("home_boton_registros"); onmouseleave=restaura(); ' }}  ></div>

                        </div>
                    </div>
                </div>


<!--Informacion de la aplicacion en forma de carrucel -->
                <div class="container margen-slider cont-body">
                    <div id="carousel-example" class="carousel slide" data-ride="carousel">
                        <!-- Wrapper for slides -->
                        <div class="row">
                            <div class="col-xs-offset-3 col-xs-6 col-md-10 col-md-offset-1">
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <div class="carousel-content">
                                            <div>
                                                <h3 class="welcome_title">Bienvenid@ a CPA Travel</h3>
                                                <p class="welcome_paragrph">
                                                    CPA Travel establece el procedimiento administrativo para otorgar viáticos y realizar su comprobación, así como, estandarizar y optimizar el control del manejo de gastos.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="carousel-content">
                                            <div>
                                                <h3 class="welcome_title">Bienvenid@ a CPA Travel</h3>
                                                <p class="welcome_paragrph">
                                                    CPA Travel tendrá la posibilidad de generar  y verificar proyectos y sub-proyectos, para de esta manera distribuir de manera correcta la asignación de los viáticos a cada uno de los empleados.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="carousel-content">
                                            <div>
                                                <h3 class="welcome_title">Bienvenid@ a CPA Travel</h3>
                                                <p class="welcome_paragrph">
                                                    CPA Travel tiene control de la aprobación de las asignaciones de los CFDI’S, al presupuesto de viáticos, y el cierre de los proyectos y sub-proyectos.
                                                </p>
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
     <!-- </div> -->
@endsection
@section('footer')
    @include('layouts.footer')
@endsection
