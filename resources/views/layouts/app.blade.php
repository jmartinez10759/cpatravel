<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <!-- Styles -->
    {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- Font Roboto -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <!-- File CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}"> -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.css') }}">
    
    <!--  -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.css') }}">

    <!-- Inicio jquery iu -->
    <link rel="stylesheet" href="{{ asset('js/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('js/jquery-ui.theme.css') }}">
    
    <link rel="stylesheet" href="{{ asset('css/master.css') }}">

    <!--Seccion de los script -->
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <!-- fin jquery iu -->
    <!--Plugin Foggy-->
    <script type="text/javascript" src="{{ asset('js/jquery.foggy.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.number.js') }}"></script>
    <!-- tyhead auto complete-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <style>
        #noty-holder{
            width: 100%;
            top: 0;
            font-weight: bold;
            z-index: 1031; /* Max Z-Index in Fixed Nav Menu is 1030*/
            text-align: center;
            position: fixed;
        }

        .alert{
            margin-bottom: 2px;
            border-radius: 0px;
        }

        #main{
            min-height:900px;
        }


        .starter-template {
            padding: 40px 15px;
            text-align: center;
        }
    </style>



    <script>
        function createNoty(message, type) {
            var html = '<div class="alert alert-' + type + ' alert-dismissable page-alert">';
            html += '<button type="button" class="close"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>';
            html += message;
            html += '</div>';
            $(html).hide().prependTo('#noty-holder').slideDown().slideUp(3500);
            $('.page-alert .close').click(function(e) {
                e.preventDefault();
                $(this).closest('.page-alert').slideUp();
            });
        };

        $(function(){
            /*
            createNoty('Hi! This is my message', 'info');
            createNoty('success', 'success');
            createNoty('warning', 'warning');
            createNoty('danger', 'danger');
             */
            //createNoty('info', 'info');

            $('.page-alert .close').click(function(e) {
                e.preventDefault();
                $(this).closest('.page-alert').slideUp();
            });
        });
    </script>

</head>
<body>
<div id="noty-holder"></div>
<div id="script_noty_holder"></div>
    <div id="blur">
        @yield('nav')
                <div class="container">
                    <div class="row">
                            @yield('content')
                    </div>
                </div>
        @if(Session::get('business_id'))
            @yield('footer')
        @endif
    </div>
    <div id="news" class="panel_foggy"></div>
    <iframe width="80%" height="90%" id="launcher" src="" frameborder=0 ALLOWTRANSPARENCY="true"></iframe>
    <div id="close_config" class="panel_foggy" onclick="blurStuff(0)">Cerrar</div>


</body>
</html>
