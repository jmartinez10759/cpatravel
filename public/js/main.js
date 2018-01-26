var isChrome = !!window.chrome && !!window.chrome.webstore;
//alert('cargaaaaaaaaa');
/**
 *Funcion para cargar por cada posicion del ciruclo cambiar la imagen 
 *@param id [description]
 *@return void
 */
    function destaca (id){
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
 /*   $('.click_href').unbind().bind('click',function(){
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
    });*/
});
$(window).resize(function()
{
    setTimeout(function(){redimensiona();  },250);
});

/*function openIframe(url)
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
}*/

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
            /*$("body").append('<div id="peor_es_nada"></div>');
            $("#peor_es_nada").css('background-color',"#fff");
            $("#peor_es_nada").css('opacity',"0.90");
            $("#peor_es_nada").css('top',"0");
            $("#peor_es_nada").css('left',"0");
            $("#peor_es_nada").css('width',"100%");
            $("#peor_es_nada").css('height',"100%");
            $("#peor_es_nada").css('display',"block");
            $("#peor_es_nada").css('position',"absolute");
            $("#peor_es_nada").css('z-index',"21474");*/
        }
        //$("#"+panel).fadeIn(100);
        //$("#close_config").show(50);
    }
    else
    {
        if(isChrome){
            //alert('this ischrome');
            $("#blur").foggy(false);
            //$("#launcher").hide();

        }
        else
        {
            //alert('el this ischrome');
            //$("#peor_es_nada").remove();
        }
        closeIframe();
        //$(".panel_foggy").fadeOut(150,function(){});
    }
}

function closeIframe()
{

    if(isChrome){//$("#blur").foggy(false);
    }
    else
    {
        $("#peor_es_nada").remove();
    }

    //$("#launcher").hide();
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

/*function getFormData($form){
    var unindexed_array = $form.serializeArray();
    var indexed_array = {};
    $.map(unindexed_array, function(n, i){
        indexed_array[n['name']] = n['value'];
    });
    return indexed_array;
}*/


