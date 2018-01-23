    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <!-- Styles -->
    {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <!-- iconos del sistema -->
    <link rel="icon" href="{{asset( 'images/logo_travel.png' )}}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{asset( 'images/logo_travel.png' )}}" type="image/x-icon" />
    <!-- Bootstrap CSS -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css"> -->
    <!-- Bootstrap JavaScript -->
    <!-- Font Roboto -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <!-- File CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}"> -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.css') }}">
    <!--  -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.css') }}">
    <!-- Inicio jquery iu -->
    <link rel="stylesheet" type="text/css" href="{{ asset('js/jquery-ui.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('js/jquery-ui.theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/master.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pnotify.custom.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/multiple-select.css') }}">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/dropzone.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">

    <!--Se anexan los script necesario para la carga de dichos script-->
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>

    <!--Se cargan script master -->
    <script type="text/javascript" src="{{ asset('js/global.system.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/tools-manager.js') }}"></script>    
    <script type="text/javascript" src="{{ asset('js/master.js') }}"></script>    

