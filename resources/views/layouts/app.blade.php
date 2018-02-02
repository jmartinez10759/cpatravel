<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('template.include-header')
</head>
<body>
    <div id="blur">
        <input type="hidden" id="id_usuario" value="{{ Session::get('user_id') }}" >
        <input type="hidden" id="token" value="{{ Session::get('token') }}" >
                <div class="container">
                    <div class="row">
                        @include('template.include-footer')
                        @yield('content')
                    </div>
                </div>
        @if(Session::get('business_id'))
            @include('template.page-footer')
        @endif
    </div>


</body>
</html>
