<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('template.include-header')
</head>
<body>
<div id="noty-holder"></div>
<div id="script_noty_holder"></div>
    <div id="blur">
        <!--@yield('nav')-->
        @include('template.page-header')
                <div class="container">
                    <div class="row">
                            @yield('content')
                    </div>
                </div>
        @if(Session::get('business_id'))
            @include('template.page-footer')
            <!--@yield('footer')-->
        @endif
            @include('template.include-footer')
    </div>
    <div id="news" class="panel_foggy"></div>
    <iframe width="80%" height="90%" id="launcher" src="" frameborder=0 ALLOWTRANSPARENCY="true"></iframe>
    <div id="close_config" class="panel_foggy" onclick="blurStuff(0)">Cerrar</div>


</body>
</html>
