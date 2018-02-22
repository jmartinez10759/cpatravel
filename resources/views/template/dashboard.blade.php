<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('template.include-header')
</head>
<body>
    
    <div id="blur" class="container-fluid" style="position: relative;">
        @include('template.page-header')
        <input type="hidden" id="id_usuario" value="{{ Session::get('user_id') }}" >
        <input type="hidden" id="token" value="{{ Session::get('token') }}" >
        <div class="container">
            @include('template.include-footer')
            @yield('content')
            @if(Session::get('business_id'))
                @include('template.page-footer')
            @endif
        </div>
    </div>
        <!--Se crea la vista del div correspondiente-->
        <div id="content-view" style="display: none">
            <br><br>
            <div class="pull-right col-sm-2">
                <button class="btn btn-default" url="" type="button" onclick="hideview(this)">Cerrar Ventana</button>
            </div>
            <div class="pull-left col-sm-1">
                <button class="btn btn-default" id="button_back_general" type="button" onclick="back_button(this)">Regresar</button>
            </div>
            <br><br><br>
            <div id="container-views"></div>
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
        <!-- pantalla obscura para la carga de las vistas del menu -->
        <div class="container" style="display: none;" id="cargador_general"></div>

</body>
</html>
