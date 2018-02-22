if(detectIE()){
    // window.location.replace("error-ie");
}
$().ready(function(){

});

/**
 *Se crea una funcion para debuger la ejecucion del front
 *@access {public} 
 *@param {element} [description]
 *@return {json}
 */
 debuger = function( element ){

    var salida = "";
    for (var p in element) {
        salida += p + ": " + element[p];
    }
    alert(salida);
    alert(  JSON.stringify(element) );
    console.log(element);

 }



function debug(arra){
    alert(dump_var(arra));
}

function dump_var(arr,level) {
    // Explota un array y regres su estructura
    // Uso: alert(dump_var(array));
    var dumped_text = "";
    if(!level) level = 0;
    //The padding given at the beginning of the line.
    var level_padding = "";
    for(var j=0;j<level+1;j++) level_padding += "    ";
    if(typeof(arr) == 'object') { //Array/Hashes/Objects
        for(var item in arr) {
            var value = arr[item];
            if(typeof(value) == 'object') { //If it is an array,
                dumped_text += level_padding + "'" + item + "' ...\n";
                dumped_text += dump_var(value,level+1);
            } else {
                dumped_text += level_padding + "'" + item + "' => \"" + value + "\"\n";
            }
        }
    } else { //Stings/Chars/Numbers etc.
        dumped_text = "===>"+arr+"<===("+typeof(arr)+")";
    }
    return dumped_text;
}

function formData(selector, template){
    /**
    * Descripcion:  Crea un objeto recuperando los valores ingresados en los campos INPUT
    * Comentario:   Los elementos html deben estar dentro de un mismo <div> y tiene que
    *               tener el atributo:data-campo="[nombre_campo]"
    * Ejemplo:      <div id="formulario"><input id="id_orden" type="hidden" data-campo="id_orden" value="{id_orden}" /></div>
    *               <script> var objData = formData('#formulario'); </script>
    * @author:      Jorge Martinez
    */
    var data = template ? template : {}; // Valores predeterminados - Opcional
    var c, f, r, v, m, $e, $elements = jQuery(selector).find("input, select, textarea");
    for (var i = 0; i < $elements.length; i++){
        $e = jQuery($elements[i]);
        // alert($elements[i]['id']);
        f = $e.data("campo");
        r = $e.attr("required") ? true: false;
        // validación de que exista un elemento

        if (!f) continue;

        // Recolección datos por tipo de elemento
        v = undefined;
        switch ($e[0].nodeName.toUpperCase()){
            case "LABEL":
                v = $e.text();
                break;
            case "INPUT":
                var type = $e.attr("type").toUpperCase();
                if (type == "TEXT" || type == "HIDDEN" || type == "PASSWORD"){
                    v = jQuery.trim($e.val());
                }
                else if (type == "CHECKBOX"){
                    v = $e.prop("checked");
                }
                else if (type == "RADIO"){
                    if ($e.prop("checked")){
                        v = $e.val();
                        // alert($e.prop("id"));
                    }
                }
                else if ($e.datepicker){
                    v = $e.datepicker("getDate");
                }
                else{
                    v = jQuery.trim($e.val());
                }
                break;
            case "TEXTAREA":
            default:
                v = jQuery.trim($e.val());
        }

        // Guarda el valor en el objeto
        if (r && (v == undefined || v == "")){

            m = $e.data("mensaje");
            if (m)
                alert(m);
            else
                alert("Es necesario especificar un valor para el campo \"" + f + "\".");
            $e.focus();
            return null;
        }
        else if (v != undefined){
                data[i] = v;
                data[f] = v;
        }


    }// next
    return data;
}
/**
 *Función que devuelve una repuesta de la peticion solicitada por GET, POST
 * @param request {object} Objeto de petición
 * @param response {object} Objeto de respuesta HTTP
 * @example
 * @param callback recide el data
 * @param pathUrl recide el controller o URL
 * @param type recide POST, GET
 * @param dataquery recibe los parametros que seran enviados por get o post
 * @returns {json} Obtiene la respuesta de la peticion solicitada
 * GET / HTTP 1.1 POST / HTT 1.1
 * EJEMPLO:
    requestAjaxSend('prueba/ejemplo', {id:1}, function(data){
        console.log(data);
    }, false, false, false, false,  'GET', 'html');
 */
function requestAjaxSend(pathUrl, data, success, beforeSend, error, complete, done, type, dataType, async){

    var dataType = dataType? dataType : 'json',
        type     = type? type : 'POST',
        beforeSend = beforeSend? beforeSend : function(){},
        error    = error? error : function(){},
        complete = complete? complete : function(xhr) {
            //check_status_xhr(xhr.status);
        },
        done     = done? done : function(){},
        async    = async? async : true;
     return $.ajax({
        async:async,
        type:type,
        url: pathUrl,
        data: data,
        dataType: dataType,
        beforeSend: function(b) {
            beforeSend(b);
        },
        success : function(data) {
            //check_session(data);
            success(data);
        },
        error: function(e) {
            error(e);
        },
        complete: function(c) {
            complete(c);
        },
        done: function() {
            done();
        }
    });
}
/**
 * Verifica la sesion del usuario
 * @param  {json} data respuesta de una llamada ajax
 * @return {void}
 */
function check_session(data){
    if(data.session_destroy){
        swal({
          title: sessionLang['title'],
          text: sessionLang['content'],
          timer: 5000,
          showConfirmButton: true,
          confirmButtonText: generalLang['aceptar']
        }).then(
            function(acept){
                location.href= 'inicio';
            },
            function(dismiss) {
                location.href= 'inicio';
            }
        );
    }
}
/**
*    // Envío de valores vía POST a una URL
*    // var objData = 'simple';
*    // var objData = new Array;    objData.push('arrelgo1'); objData.push('arrelgo2');
*    // var objData = {id: 1, name: 'oscar', value: 'valores'};
*/
function send_post(data, url, target, debug){
    if(data && url){
        var elements, keys = false;
        var n  = Math.floor((Math.random() * 100) + 1); //1 al 100
        target = (!target)?'_self':target;
        // Crea formulario
        var form = document.createElement("form");
        form.setAttribute("id", "frm-"+n);
        form.setAttribute("method", "post");
        form.setAttribute("action", url);
        form.setAttribute("target", target);
        // Contruccion de inputs
        if(data.constructor === String || data.constructor === Number){
            // Simple: un solo dato - String
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("id", "id");
            hiddenField.setAttribute("name", "id");
            hiddenField.setAttribute("value", data);
            form.appendChild(hiddenField);
        }
        else if(data.constructor === Array){
            // Array: arreglo simple - ['1','2','n']
            elements = data.length;
            var hiddenField = new Array;
            for(var i=0; i<elements; i++){
                hiddenField[i] = document.createElement("input");
                hiddenField[i].setAttribute("type", "hidden");
                hiddenField[i].setAttribute("id", "input-"+i);
                hiddenField[i].setAttribute("name", "input-"+i);
                hiddenField[i].setAttribute("value", data[i]);
                form.appendChild(hiddenField[i]);
            }
        }
        else if(data.constructor === Object){
            // Object: arreglo asociativo - {id: 1, name: 'oscar', value: 'valores'}
            elements = Object.keys(data).length;
            keys = Object.keys(data);
            var hiddenField = new Array;
            for(var i=0; i<elements; i++){
                hiddenField[i] = document.createElement("input");
                hiddenField[i].setAttribute("type", "hidden");
                hiddenField[i].setAttribute("id", keys[i]);
                hiddenField[i].setAttribute("name", "data["+keys[i]+"]");
                hiddenField[i].setAttribute("value", data[keys[i]]);
                form.appendChild(hiddenField[i]);
            }
        }
        document.body.appendChild(form); //Muestra formulario en el documento
        if(debug){
            return false;
        }else{
            form.submit();  //Envía datos a URL
        }
    }else{
        return false;
    }

}
/**
 * Redirecciona a la url recibida
 * @param  {txt} uri recibida
 * @return {void}
 */
function redirect(url){
    url = (url)?url:'';
    location.href=url;

}
/**
 * Valida formulario usando jquery.validate
 * @param  {idObj} ID del DOM HTML
 * @param  {rules} Objeto JSON con relgas de validación
 * @param  {messages} Objeto JSON con mensajes para cada regla
 * @return {void}
 */
function frmValidate(idObj,rules,messages){
    // Mensajes
    var messages_default = {
        required:       validatorLang['required'],
        remote:         validatorLang['remote'],
        email:          validatorLang['email'],
        url:            validatorLang['url'],
        date:           validatorLang['date'],
        dateISO:        validatorLang['dateISO'],
        number:         validatorLang['number'],
        digits:         validatorLang['digits'],
        creditcard:     validatorLang['creditcard'],
        equalTo:        validatorLang['equalTo'],
        accept:         validatorLang['accept'],
        maxlength:      validatorLang['maxlength'],
        minlength:      validatorLang['minlength'],
        rangelength:    validatorLang['rangelength'],
        range:          validatorLang['range'],
        max:            validatorLang['max'],
        min:            validatorLang['min']
    };
    jQuery.extend(jQuery.validator.messages,messages_default);
    if(!messages) messages = messages_default;
    // Selects
    // jQuery.validator.setDefaults({ ignore: ":hidden:not(select)" });
    // Inicializa
    jQuery(idObj).validate({
        ignore: '.ignore, .select2-input',
        rules: rules,
        messages: messages,
        errorElement : 'div',
        errorPlacement: function(error, element) {
          var placement = $(element).data('error');
          if (placement) {
            $(placement).append(error)
          } else {
            error.insertAfter(element);
          }
        }
     });

}
// MODALES
/**
 *Funcion para construir un modal
 *@param string uri [description]
 *@return void
 */
function buildModal(uri){
    if(uri){
        $.ajax({
            type: "POST",
            url: uri,
            dataType: 'json',
            data: {},
            success: function(data){
                if(data.success){
                    jQuery("#modal-custom").empty();
                    jQuery("#modal-custom").append(data.modal);
                    $('#'+data.id).openModal();
                }
            }
        });
    }
}

function buildModalTimeout(uri, timeout){
    if(uri){
        timeout = (!timeout)?2000:timeout;
        jQuery.ajax({
            type: "POST",
            url: uri,
            dataType: 'json',
            data: {},
            success: function(data){
                if(data.success){
                    jQuery("#modal-custom").empty();
                    jQuery("#modal-custom").append(data.modal);
                    jQuery('#'+data.id).openModal();
                    setTimeout(function(){ jQuery('#'+data.id).closeModal(); }, timeout);
                    setTimeout(function(){ jQuery("#modal-custom").empty();}, timeout+1000);
                }
            }
        });
    }
}
// Fin MODALES
/**
 * Contruye una notificación toast
 * @param  {string} mensaje mensaje de la notificacion
 * @param  {sring} clase   clase de la notifiacion
 * @param  {int} tiempo  tiempo en mili segundos de duracion
 * @return {void}
 */
function buildToast(mensaje, clase, tiempo, completeCallBack) {
    mensaje  = mensaje? mensaje : 'Toast';
    tiempo   = tiempo? tiempo : 5000;
    callback = completeCallBack? completeCallBack : function(){};
    clase   = clase? clase : 'green';
    Materialize.toast(mensaje, tiempo, clase, callback);

}
/**
 *Funcion para construir el sweetalert
 *@param {titulo} [type][description]
 *@param {mensaje} [type][description]
 *@param {clase} [type][description]
 */
function buildSweetAlert(titulo, mensaje, clase) {
    swal(
        titulo,
        mensaje,
        clase
    );
}
/**
 *Funcion para construir el sweetalert
 *@param {titulo} [type][description]
 *@param {mensaje} [type][description]
 *@param {clase} [type][description]
 */
    function pnotify( titulo, mensaje, clase ){

        new PNotify({
            title: titulo,
            text: mensaje,
            type: clase
        });
        
    }


/**
 *Funcion 
 *@param {titulo} [type][description]
 *@param {mensaje} [type][description]
 *@param {success} [type][description]
 *@return void
 */
 function buildSweetAlertOptions( titulo, mensaje, success ){

    /*swal({
          title: titulo,
          text: mensaje,
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Aceptar',
          cancelButtonText: 'Cancelar',
          confirmButtonClass: 'btn btn-success',
          cancelButtonClass: 'btn btn-danger',
          buttonsStyling: false,
          allowOutsideClick: false
    }).then(function () {
        success();
    }, function (dismiss) {
        if (dismiss === 'cancel') {
           
        }   
    });*/

    swal({
          title: titulo,
          text: mensaje,
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Aceptar",
          cancelButtonText: "Cancelar",
          closeOnConfirm: true,
          closeOnCancel: true
        },
        function(isConfirm) {
          if (isConfirm) {
            success();
          } else {
          }

        });
 
 }
/**
 * Carga de selects
 * @param  {strin} url    [URL del servidor]
 * @param  {int} id     [id del elemento]
 * @param  {String} load   [#id del elemento donde se carga]
 * @param  {String} select [id del select cargado]
 * @return {Void}
 * var url = 'entidades/get_entidades',
        load = 'load-entidades',
        select = 'id_entidad';
    loadItemSelect(url, id_pais, load, select);
 */
var loadItemSelect = function(url, data, load, select) {
    console.log('#'+select);
    requestAjaxSend(url, data, function(data){
        $('#'+load).html(data);
        $('#'+select).material_select();
    }, function(){
        $('#'+load).html('<div class="progress"><div class="indeterminate"></div></div>');
    });
}
/**
 * Carga de selects dependientes
 * @param  {strin} url    [URL del servidor]
 * @param  {object} data     [variables en objeto]
 * @param  {String} load   [#id del elemento donde se carga]
 * @param  {String} select [id del select cargado]
 * @return {Void}
 * var  url = 'entidades/get_entidades',
        data = {id_opcion: 1, id_cliente: 1},
        load = 'load-entidades',
        select = 'id_entidad';
    loadItemSelect(url, data, load, select);
 */
var loadFormSelect = function(url, data, load, idselect) {
    requestAjaxSend(url, data, function(select){
        $('#'+load).html(select);
        $('#'+idselect).material_select();
    }, function(){
        $('#'+load).html('<div class="progress"><div class="indeterminate"></div></div>');
    });
}

/**
 * funcion para resetear los select dependientes cargados de un formulario
 * @param {object} data identificador del select para resetear
 * @example valor del objeto data
 * data = [{0:'select.sede'},{0:select#tipo_empleado}]
 */
var reset_select_dependientes = function (data){
    $(data).each( function(key, obj){
        $(obj[0]+ ' option').each( function(index, option){
            if (index > 0) {
                $(this).remove();
            }
        });
        $(obj[0]).prop('selectedIndex', 0); //Sets the first option as selected
        $(obj[0]).material_select();
    });
}

var getIdsMenu = function(name) {
    var ids_menus = [];
    $('input[name='+name+']:checked').each(function(){
        ids_menus.push($(this).val());
    });
    return ids_menus;
}
/**
 *Detección de iExplorer
 *@return integer [description]
 */
function detectIE() {
    var ua = window.navigator.userAgent;
    var msie = ua.indexOf('MSIE ');
    if (msie > 0) {
        // IE 10 or older => return version number
        return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
    }
    var trident = ua.indexOf('Trident/');
    if (trident > 0) {
        // IE 11 => return version number
        var rv = ua.indexOf('rv:');
        return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
    }
    // var edge = ua.indexOf('Edge/');
    // if (edge > 0) {
    //    // IE 12 => return version number
    //    return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
    // }
    // other browser
    return false;
}

function selects_requeridos(formulario){
    var items_vacios = 0;
    var padre = (formulario) ? '#'+formulario+' ' : '';

    jQuery(padre+" .requerido").each(function(){
        if(jQuery(this).prop('tagName')=='SELECT'){
            var attr = $(this).attr('multiple');
            if(typeof attr !== typeof undefined && attr !== false){
                if(!jQuery.trim(jQuery("[name='"+jQuery(this).attr('name')+"'] option")).length>0){
                    items_vacios++;
                    ids = jQuery(this).attr('name')+'|'+ids;
                }
                if(!jQuery.trim(jQuery("[name='"+jQuery(this).attr('name')+"'] option:selected")).length>0){
                    items_vacios++;
                    ids = jQuery(this).attr('name')+'|'+ids;
                }
            }else{
                var select  = jQuery("select[name='"+jQuery(this).attr('name')+"'] option:selected");
                var select_empty = jQuery("select[name='"+jQuery(this).attr('name')+"']");
                var select_focus = jQuery("select[name='"+jQuery(this).attr('name')+"']").closest('div');
                var name = jQuery(this).attr('name');

                var msg = '<div id="'+name+'-error" class="error-select"> '+formValidateLang.required+'</div>';
                if(!select.val()){

                    select_focus.focus();
                    $('#'+name+'-error').remove();
                    select_focus.append(msg);
                    select_empty.change(function() {
                      $('#'+name+'-error').remove();
                    });
                    items_vacios++
                }
            }

        }
    });
    return items_vacios;
}


function values_enteros(formulario){
    var padre = (formulario) ? '#'+formulario+' ' : '';
    var enteros = true;

    jQuery(padre+" .digit").each(function(){
        var name = $(this).attr('name');
        var msg = '<div id="'+name+'-error-input" class="error-select"> '+formValidateLang.digits+'</div>';
        if(isInt(jQuery(this).val())){
        }else{
            var name = $(this).attr('name');
            var item = $(this).closest('div');
            $('#'+name+'-error-input').remove();
            item.append(msg);
            $(this).focus(function(event) {
                $('#'+name+'-error-input').remove();
            });
            enteros = false;
        }
    });
    return enteros;
}
/**
 * Comprueba si un valor es de tipo entero
 * @return {Boolean}   [devuelve true si es entero, false si no lo es]
 */
function isInt(x) {
   var y = parseInt(x, 10);
   return !isNaN(y) && x == y && x.toString() == y.toString();
}
/**
 *Funcion para la carga de los estilos de la tabla de bootstraps
 *@param id [description]
 *@return void
 */
 function initDataTable( id ) {
    
    $('#'+id).DataTable({
        /*fnInitComplete: function(a, t) {
                var l = jQuery(this).parents(".dataTables_wrapper").eq(0);
                l.find(".dataTables_length").addClass("input-field"), l.find(".dataTables_length label select").prependTo(l.find(".dataTables_length")), l.find(".dataTables_length select").material_select(), l.find(".dataTables_filter").addClass("input-field"), l.find(".dataTables_filter").addClass("without-search-bar"), l.find(".dataTables_filter label input").prependTo(l.find(".dataTables_filter"))
            },*/
        "language": {
            "lengthMenu": "Mostrar _MENU_",

            "zeroRecords": "Sin Registros",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "Sin Registros",
            "infoFiltered": "(Resultado de _MAX_ registros)",
            'search': 'Búsqueda'
        },
        "searching":  true,
        "scrollX":    true,
        "responsive": true,
        "details":    true,
        "dom": "<'row no-gutter'\t<'col s12 m2'l>\t<'col s12 offset-m6 m4'f>><''tr><'row no-gutter'\t<'col s12 m4'i>\t<'col s12 m8'p>>",
        "iDisplayLength": 50,
        "bFilter": false,
        "aaSorting" : [[0, "asc"]],
        fnRowCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
            /*if ( aData[0] % 2 == 1 ){
                jQuery('td', nRow).css('background-color', '#ffffff');
            }else {
                jQuery('td', nRow).css('background-color', '#eeeeee');
            }
            jQuery('td', nRow).css('border-left', '1px solid #dddddd');
            jQuery('td', nRow).css('font-size', '12px');*/
        }
    });

 }
/**
 * checa el status http de la petición, por default se mandan mensajes de errores del
 * status 500 error del servidor
 * @param  {[type]} status      [description]
 * @param  {[type]} title       [description]
 * @param  {[type]} text        [description]
 * @param  {[type]} type        [description]
 * @param  {[type]} showMessage [description]
 * @param  {[type]} accept      [description]
 * @param  {[type]} dismiss     [description]
 * @return {[type]}             [description]
 */
function check_status_xhr(status, title, text, type, accept) {

    var showMessage = false,
        title = title? title : generalLang['error'],
        text  = text? text : xhrStatusLang['error500Msg'],
        type = type? type : 'error',
        accept = accept? accept : function(){};
    switch(status) {
        case 500:
            showMessage = true;
            break;
    }

    if(showMessage) {
        swal({
          title: title,
          text: text,
          showConfirmButton: true,
          confirmButtonText: generalLang['aceptar'],
          type: type,
          allowOutsideClick: false
        }).then(
            function(a){
                accept(a);
            },
            function(d) {

            }
        );
    }

}
/**
 *Funcion para validar los campos que se requieren
 *@param array validacion [description]
 *@return void
 */
    function validacion_fields(validacion){
        
        if ( typeof validacion == "object" ) {

            for (var i = 0; i < validacion.length; i++) {
                var valores = $('#'+validacion[i]).val();
                if (valores == "" || valores == 0 || valores == "null") {
                    $('#'+validacion[i]).parent().parent().addClass('has-error');
                    //alert("Por favor de verifiar el campo de color rojo");
                    pnotify('Campos Vacios','Favor de verificar los campos de color rojo!','error');
                    return 'error';
                }else{
                    $('#'+validacion[i]).parent().parent().removeClass('has-error');
                }
            };
            
        }

   
    }
/**
 *Funcion para cargar los valores de cada campo
 *@param json data [description]
 *@return void
 */
    function get_values(json){

        $.each(json,function(key,values){
            $('#'+key).val(values);
        });
    
    }
/**
 *Funcion para cargar los valores de cada campo
 *@param array arreglo [description]
 *@return void
 */
    function clear_values( arreglo ){

        for (var i = 0; i < arreglo.length; i++) {
            $('#'+arreglo[i]).val('');
            $('.'+arreglo[i]).val('');
            
        }
    
    }
/**
 *Funcion para la carga de archivos al servidor por medio de dropzone
 *@param id [type] [description]
 *@param url [type][description]
 *@param maxfile [type][description]
 *@param type_file [type][description]
 *@param methods [type][description]
 *@return void
 */
    function upload_file(id,path_url,maxfile,type_file,methods){
        //path_url = "Upload/Upload_file";
        $('#modal_dialog').css('width','60%');
        Dropzone.autoDiscover = false;
        $('#div_dropzone_file').html('<div class="dropzone" id="dropzone_xlsx_file" height="20px"><div class="fallback"><input name="file" type="file"/></div></div>').ready(function(){
                var jsonResponse;
                    $("#dropzone_xlsx_file").dropzone({
                                    uploadMultiple: true,
                                    url: path_url,
                                    maxFiles: maxfile,
                                    paramName: "file",
                                    acceptedFiles: type_file,
                                    dictDefaultMessage: "Favor de Cargar Archivo",
                                    dictFallbackMessage: "layoutLang['mjs_navegador']",
                                    dictFileTooBig: "layoutLang['file_size']",
                                    dictInvalidFileType: "layoutLang['file_type']",
                                    dictResponseError: "layoutLang['error_server']",
                                    dictCancelUpload: "layoutLang['cancel']",
                                    dictCancelUploadConfirmation: "layoutLang['confirmacion']",
                                    dictRemoveFile: "layoutLang['eliminar_file']",
                                    dictMaxFilesExceeded: "No se puede subir mas archivos de los permitidos",
                                    headers: {
                                        'usuario': $('#id_usuario').val()
                                        ,'token':  $('#token').val()
                                        ,'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    //dictRemoveFile:true,
                                    success:function( data, datos ) {
                                        var jsonRequest = JSON.parse(datos);
                                           if (jsonRequest.success === true) {
                                                pnotify('Archivo Cargado.!','El archivo seleccionado se cargo con exito','success');
                                           }else{
                                                pnotify('No se Cargado Correctamente.!','El archivo no se cargo con exito','error');
                                           }
                                           methods(jsonRequest);

                                    },
                                    accept: function(file, done){
                                        if (file.name == "imagen.jpg") {done("Archivo Incorrecto");}else {done();}
                                    },
                                    sending: function(parmt1,parmt2,data){
                                            data.append('id', id );
                                            //$('.loader').show();
                                            //$('#dropzone_div').hide();
                                    },
                                    init: function() {
                                        this.on("complete", function(file) {
                                            //this.removeAllFiles(true);
                                        });
                                    },
                                    complete: function(data) {
                                        //pnotify('Archivo Cargado.!','El archivo seleccionado se cargo con exito','success');
                                            /* swal(
                                              'Archivo Cargado Correctamente.!',
                                              datos.response.mgs,
                                              'success'
                                            );*/
                                    }

                                });

                    });

    }
    /**
     *Funcion para crear la descarga del layout en general
     *@param [type] [description]
     *@param [type] [description]
     *@return void 
     */
    function download_layout_general(url,data){
        var fields = {'data' : data};
        send_post(fields,url,false,false);
    }
    /**
     *Funcion para crear la descarga del pdf en general
     *@param [type] [description]
     *@param [type] [description]
     *@return void 
     */
    function download_pdf_general(url,data,success ){
        var fields = {'data' : data};
        //send_post(fields,url,false,false);
        requestAjaxSend( url,fields,function(mgs) {
            success(mgs);
        });
    }
    /**
     *Funcion para contar los dias trancurridos
     *@param fecha1
     *@param fecha2
     *@return date
     */
    restaFechas = function(fecha1,fecha2){

        var aFecha1 = fecha1.split('-'); 
        var aFecha2 = fecha2.split('-'); 
        /*formato de aaaa/mm/dd */
        var fFecha1 = Date.UTC(aFecha1[2],aFecha1[1]-1,aFecha1[0]); 
        var fFecha2 = Date.UTC(aFecha2[2],aFecha2[1]-1,aFecha2[0]); 
        var dif = fFecha2 - fFecha1;
        var dias = Math.floor(dif / (1000 * 60 * 60 * 24)); 
        return dias;
    
    }
    /**
     *Funcion para contar los dias trancurridos
     *@param fecha1
     *@param fecha2
     *@return date
     */
    convert_date = function( fecha ){
        var fechas = fecha.split('-');
        var anio = fechas[0]; 
        var mes = fechas[1];
        var dia = fechas[2];
        var fnew = dia+"-"+mes+"-"+anio;
        return fnew;
    }
    /**
     *Funcion para validar si las fecha inicial es menor a la final
     *@param fecha1 [description]
     *@param fecha2 [description]
     *@return json
     */
    validate_date =  function( fecha1, fecha2 ){

        var fecha_inicial = new Date(fecha1);
        var fecha_fin = new Date(fecha2);

        if ( fecha2 < fecha1 ) {
            return false;
        }else{
            return true;
        }

    }
    /**
     *Funcion para regresar a la vista anterior
     *@param url [description]
     *@return void
     */
    back_button = function( object ){

          var ruta = $('#return').val();
          $('#button_back_general').removeAttr('url');
          $('#button_back_general').attr('url',ruta);
          $('#button_back_general').attr('disabled',false);
          load_views(object);
          
    }
    /**
     *Function creada para la creacion de LocalStorage y SessionStorage
     *@param 
     *@return object
     */
    $myLocalStorage = (function(){
        var name = null;
        return {
            set: function(k, value){
                localStorage.setItem(k, JSON.stringify(value));
            },
            get: function(k){
                var data = localStorage[k];
                
                if(data === undefined) throw 'Clave No Localizada';
                
                return JSON.parse(data);
            },
            remove: function(k){
                localStorage.removeItem(k);
            }
        };
    })();
    /**
     *Funcion para generar una cadena en un arreglo de varios registros
     *@access public
     *@param table [description]
     *@param identificador [description]
     *@return array[description]
     */
     table_matrix = function( table, identificador ){

        var matrix = [];
        var conteo = 0;

        $('#'+table+' tbody').find('tr').each(function(){
            var response = "";
            response += $(this).attr(identificador)+"|";

            $(this).find('td').each(function(){
                console.log($(this).text());
                response += $(this).text()+"|";
            });
            matrix[conteo] =  response;
            conteo++;
        });
        return matrix;        

     }
     /**
     *Funcion para obtener el dominio actual.
     *@access public
     *@param table [description]
     *@param identificador [description]
     *@return array[description]
     */
     domain = function( url ){

        var path_url = window.location.protocol+"//"+window.location.host+"/"+url;
        return path_url;

     }
     /**
     *Funcion para generar una tabla dinamica por medio de un json.
     *@access public
     *@param json [description]
     *@param id_table [description]
     *@return html[description]
     */
     data_table_general = function( json, id_table ){

        var tbody = '';
        $.each(json,function(key,value){
            tbody += '<tr>';
            $.each(value,function(keys,values){
                tbody += '<td>'+values+'</td>';
            });
            tbody += '</tr>';

        });

        $('#'+id_table+' tbody').html('');
        $('#'+id_table+' tbody').html(tbody);
     }
     /**
      *Funcion para la carga de registros
      *return void
      */
      loader_msj = function(){
            $('#loader-msj').show();
            $('#container-views').hide();
      }
      /**
       *Funcion para ocultar el mensaje generado.
       *@return void
       */
       loader_hide_msj = function(){
            $('#container-views').show();
            $('#loader-msj').hide();
       }
      /**
       *Funcion para dar formato a un numero
       *@param amount
       *@param decimals
       *@return numeber
       */
        number_format = function(amount, decimals) {

            amount += ''; // por si pasan un numero en vez de un string
            amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto

            decimals = decimals || 0; // por si la variable no fue fue pasada

            // si no es un numero o es igual a cero retorno el mismo cero
            if (isNaN(amount) || amount === 0) 
                return parseFloat(0).toFixed(decimals);

            // si es mayor o menor que cero retorno el valor formateado como numero
            amount = '' + amount.toFixed(decimals);

            var amount_parts = amount.split('.'),
                regexp = /(\d+)(\d{3})/;

            while (regexp.test(amount_parts[0]))
                amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');

            return amount_parts.join('.');
        }
        /**
         *Funcion de Jquery donde impide utilizar letras en campos de numero
         *@param array [description]
         *@return
         */
         function numerico(object){

                object.value = (object.value + '').replace(/[^0-9]/g, '');            

         }
         /**
          *Funcion de jquery para colocar un valor predeterminado
          *@param
          */
        function value_inputs( object ){
            $(object).val('');
        }
        /**
         *Metodo para mostrar y/o ocultar secciones
         *@param mostrar [descritption]
         *@param ocultar [description]
         *@return void
         */
        function mostrar_elements( mostrar, ocultar){
            
            for (var i = 0; i < mostrar.length; i++) {
                //$('#'+mostrar[i]).toggle('slow');
                $('#'+mostrar[i]).show('slow');
                $('.'+mostrar[i]).show('slow');

            }
            for (var i = 0; i < ocultar.length; i++) {
                console.log(ocultar[i]);
                //$('#'+ocultar[i]).toggle('slow');
                $('#'+ocultar[i]).hide('slow');
                $('.'+ocultar[i]).hide('slow');

            }

        }
    /**
     *Metodo para mostrar y/o ocultar secciones
     *@param mostrar [descritption]
     *@param ocultar [description]
     *@return void
     */
    function toggle_mostrar(identificador){

        for (var i = 0; i < identificador.length; i++) {
            $('#'+identificador[i]).toggle('slow');
            $('.'+identificador[i]).toggle('slow');

        }

    }
    /**
     *Funcion que valida si el dato es mayor a un numero y agrega un indice
     *@return indice
     */ 
    addZero = function( i ){
        
        return ( i < 10 )? '0'+i: i;

    }
    /**
     *Funcion para obtener la fecha y horas
     *@return date fecha[descripcion]
     */    
    get_actual_fulldate = function( sign = '-', sign_hrs = ":" ) {
        var d = new Date();
        var day = addZero(d.getDate());
        var month = addZero(d.getMonth()+1);
        var year = addZero(d.getFullYear());
        var h = addZero(d.getHours());
        var m = addZero(d.getMinutes());
        var s = addZero(d.getSeconds());
        return day + sign + month + sign + year + " (" + h + sign_hrs + m + sign_hrs + s + ")";
    }
    /**
     *Funcion para obtener las horas
     *@return date fecha[descripcion]
     */    
    get_actual_hour = function( sign = ':' ) {
        var d = new Date();
        var h = addZero(d.getHours());
        var m = addZero(d.getMinutes());
        var s = addZero(d.getSeconds());
        return h + sign  + m + sign  + s;
    }
    /**
     *Funcion para obtener la fecha
     *@return date fecha[descripcion]
     */ 
    get_actual_date = function( sign = '-' ) {
        var d = new Date();
        var day = addZero(d.getDate());
        var month = addZero(d.getMonth()+1);
        var year = addZero(d.getFullYear());
        return day + sign + month + sign + year;
    }