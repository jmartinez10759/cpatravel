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
<!--
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    {{--<script src="{{ asset('js/app.js') }}"></script>--}}
        <script
                src="https://code.jquery.com/jquery-3.2.1.js"
                integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
                crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script> -->



    <!-- <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- Font Roboto -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <!-- File CSS -->


    <!-- Inicio jquery iu -->
    <link rel="stylesheet" href="{{ asset('js/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('js/jquery-ui.theme.css') }}">
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <!-- fin jquery iu -->

    <!--Plugin Foggy-->
    <script type="text/javascript" src="{{ asset('js/jquery.foggy.min.js') }}"></script>

    <!-- tyhead auto complete-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>


</head>
<body>
<script>
    var isChrome = !!window.chrome && !!window.chrome.webstore;
    //alert('cargaaaaaaaaa');
    function destaca (id)
    {
        if (id == 'home_boton_proceso') { $("#maincircle").attr( 'src', 'images/proceso_circulo.png'); }
        if (id == 'home_boton_edo_cta') { $("#maincircle").attr( 'src', 'images/edo_cta_circulo.png'); }
        if (id == 'home_boton_politicas') { $("#maincircle").attr( 'src', 'images/politicas_circulo.png'); }
        if (id == 'home_boton_registros') { $("#maincircle").attr( 'src', 'images/registros_circulo.png'); }

    }


    function showMenu()
    {
        $('.menu-item').slideToggle(350);
    }

    function restaura()
    {
        $("#maincircle").attr('src','images/circulo.png');
    }
    /* inicio javascript usado para foggy*/

    $(document).ready(function(){
        //closeIframe();
        blurStuff(0);
        redimensiona();
        $('.click_href').unbind().bind('click',function(){
            var url = $(this).attr('data-href');
            if(isChrome)
            {
                $("#blur").foggy({
                    blurRadius: 15,         // In pixels.
                    opacity: 0.5,           // Falls back to a filter for IE.
                    cssFilterSupport: true  // Use "-webkit-filter" where available.
                });
            }
            else
            {
                $("body").append('<div id="peor_es_nada"></div>');
                $("#peor_es_nada").css('background-color',"#fff");
                $("#peor_es_nada").css('opacity',"0.90");
                $("#peor_es_nada").css('top',"0");
                $("#peor_es_nada").css('left',"0");
                $("#peor_es_nada").css('width',"100%");
                $("#peor_es_nada").css('height',"100%");
                $("#peor_es_nada").css('display',"block");
                $("#peor_es_nada").css('position',"absolute");
                $("#peor_es_nada").css('z-index',"21474");
            }
            $("#launcher").attr('src',url);
            $("#launcher").show(250);
            $("#close_config").show(50);
        });
    });
    $(window).resize(function()
    {
        setTimeout(function(){redimensiona();  },250);
    });

    function openIframe(url)
    {
        if(isChrome)
        {
            $("#blur").foggy({
                blurRadius: 15,         // In pixels.
                opacity: 0.5,           // Falls back to a filter for IE.
                cssFilterSupport: true  // Use "-webkit-filter" where available.
            });
        }
        else
        {
            $("body").append('<div id="peor_es_nada"></div>');
            $("#peor_es_nada").css('background-color',"#fff");
            $("#peor_es_nada").css('opacity',"0.90");
            $("#peor_es_nada").css('top',"0");
            $("#peor_es_nada").css('left',"0");
            $("#peor_es_nada").css('width',"100%");
            $("#peor_es_nada").css('height',"100%");
            $("#peor_es_nada").css('display',"block");
            $("#peor_es_nada").css('position',"absolute");
            $("#peor_es_nada").css('z-index',"21474");

        }

        $("#launcher").attr('src',url);
        $("#launcher").show(250);
        $("#close_config").show(50);
    }

    function blurStuff(action,panel)
    {
        //alert('entra a '+action);
        var isChrome = !!window.chrome && !!window.chrome.webstore;
        if(action==1)
        {
            if(isChrome)
            {
                $("#blur").foggy({
                    blurRadius: 15,         // In pixels.
                    opacity: 0.5,           // Falls back to a filter for IE.
                    cssFilterSupport: true  // Use "-webkit-filter" where available.
                });
            }
            else
            {
                $("body").append('<div id="peor_es_nada"></div>');
                $("#peor_es_nada").css('background-color',"#fff");
                $("#peor_es_nada").css('opacity',"0.90");
                $("#peor_es_nada").css('top',"0");
                $("#peor_es_nada").css('left',"0");
                $("#peor_es_nada").css('width',"100%");
                $("#peor_es_nada").css('height',"100%");
                $("#peor_es_nada").css('display',"block");
                $("#peor_es_nada").css('position',"absolute");
                $("#peor_es_nada").css('z-index',"21474");
            }
            $("#"+panel).fadeIn(100);
            $("#close_config").show(50);
        }
        else
        {
            if(isChrome){
                //alert('this ischrome');
                //$("#blur").foggy(false);
                //$("#launcher").hide();

            }
            else
            {
                //alert('el this ischrome');
                $("#peor_es_nada").remove();
            }
            closeIframe();
            $(".panel_foggy").fadeOut(150,function(){});
        }
    }

    function closeIframe()
    {

        if(isChrome){
            //$("#blur").foggy(false);
            }
        else
        {
            $("#peor_es_nada").remove();
        }

        $("#launcher").hide();
    }
    function redimensiona()
    {
        ancho = $(window).width();
        alto = $(window).height();
        var fuente1 = alto * .16;
        $("#home_pendientes").css('font-size',fuente1);
    }
    $(window).resize(function()
    {
        setTimeout(function(){redimensiona();  },250);
    });

    function getFormData($form){
        var unindexed_array = $form.serializeArray();
        var indexed_array = {};
        $.map(unindexed_array, function(n, i){
            indexed_array[n['name']] = n['value'];
        });
        return indexed_array;
    }



</script>
<div id="blur">
    @yield('nav')
    <div class="container">
        <div class="row">

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Open modal for @mdo</button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@fat">Open modal for @fat</button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Open modal for @getbootstrap</button>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="recipient-name" class="form-control-label">Recipient:</label>
                                    <input type="text" class="form-control" id="recipient-name">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="form-control-label">Message:</label>
                                    <textarea class="form-control" id="message-text"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Send message</button>
                        </div>
                    </div>
                </div>
            </div>



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
