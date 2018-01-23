<div class="container-fluid container_head">
    <div class="row">
        <div class="col-md-4 col-xs-4">
            <a href="{{ route('beginin') }}">
                <img src="{{ asset('images/logo_travel.png') }}" alt="CPA Travel" title="CPA Travel" class="img-responsive center-block">
            </a>
        </div>
        <div class="col-md-6 col-xs-8 title_menu center-block no_padding">
            <div class="box_nom_emp">
                @if(Session::get('business_id'))
                    <div class="col-md-12">Usuario: {{ Session::get('user_id') }}-{{ Session::get('name') }} </div>
                    <div class="col-md-12">Empresa: {{ Session::get('business_description') }}</div>
                    <!--<div class="col-md-12">Grupo: {{ Session::get('group_id') }}</div>-->
                @endif
            </div>
        </div>
        <div class="col-md-2 col-xs-12">
            <div class="col-md-12 col-xs-12 menu_btns">
                <div class="col-md-4 col-xs-4">
                    @if(Session::get('business_id'))
                        <a href="{{ route('list') }}">
                            <img class="center-block" title="Cambio de Empresa" alt="Cambio de Empresa" src="{{ asset('images/cambio_icono.png') }}">
                        </a>
                    @endif
                </div>
                <div class="col-md-4 col-xs-4">
                    @if(Session::get('token'))
                        <a href="{{ route('logout') }}">
                            <img class="center-block" title="Cerrar Sesión" alt="Cerrar Sesión" src="{{ asset('images/cerrar_sesion_icono.png') }}">
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>