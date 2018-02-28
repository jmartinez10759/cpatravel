$().ready(function(){

    var url = domain('politicas/upload');
    //var url = "";
    upload_file(false,url,1,'.jpg, .png, .ico',function(json){
        $('#etiqueta_img').val(json.url_file);
    });
    $("#fecha").val( get_actual_date("-","yy-mm-dd") );
    $("#fechaDesde").val( get_actual_date("-","yy-mm-dd") );
    $("#fechaHasta").val( get_actual_date("-","yy-mm-dd") );

	$("#fechaDesde").datepicker({
        //minDate: 0,
        maxDate: "+1M +0D",
        onSelect: function(selected,event) {

            var fecha_fin = $('#fechaHasta').val().trim();
            var fecha_inicio = $(this).val().trim();
            if( fecha_inicio != null && fecha_fin != null ){
                var dias = restaFechas(fecha_inicio,fecha_fin);
                if (dias < 0) {
                    pnotify('Fechas Incorrectas','La fecha inicial no debe ser mayor a la final','error');
                    $(this).val( get_actual_date("-","yy-mm-dd") );
                    $(this).parent().parent().addClass('has-error');
                    return;
                }

            }
        },
        dateFormat: 'yy-mm-dd'
    });

    $("#fechaHasta").datepicker({
        //minDate: 0,
        maxDate: "+1M +0D",
        onSelect: function(selected,event) {
            var fecha_inicio = $('#fechaDesde').val().trim();
            var fecha_fin = $(this).val().trim();
            if( fecha_inicio != null &&  fecha_fin != null ) {
                var dias = restaFechas(fecha_inicio,fecha_fin);
                if (dias < 0) {
                    pnotify('Fechas Incorrectas','La fecha inicial no debe ser mayor a la final','error');
                    $("#fechaDesde").val( get_actual_date("-","yy-mm-dd") );
                    $("#fechaDesde").parent().parent().addClass('has-error');
                    return;
                }
            }
        },
        dateFormat: 'yy-mm-dd'
    });

    $("#fecha").datepicker({
        minDate: 0,
        onSelect: function(selected,event) {
           // var fecha_inicio = $('#fecha_inicio').val().trim();
           // var fecha_fin = $(this).val().trim();
            //if( fecha_inicio != null &&  fecha_fin != null ) {
                //var dias = restaFechas(fecha_inicio,fecha_fin);
               /* if (dias < 0) {
                    pnotify('Fechas Incorrectas','La fecha inicial no debe ser mayor a la final','error');
                    $("#fecha_inicio").val( get_actual_date() );
                    $("#fecha_inicio").parent().parent().addClass('has-error');
                    return;
                }*/
           // }
        },
        dateFormat: 'yy-mm-dd'
    });



});
/**
 *Funcion para la agregar una factura
 *@return void
 */
 agregar_comprobante = function(){
 	
 	var url = domain('comprobantes/create');
 	var fields = {
 		'emisor' 		: $('#emisor').val()
 		,'receptor' 	: $('#receptor').val()
 		,'uuid' 		: $('#uuid').val()
 		,'importe' 		: $('#importe').val()
 	}

 	create_register(url,fields,function(json){


 	},function(json){

 	});

 }
 /**
 *Funcion para la agregar una factura
 *@return void
 */
 search_comprobante = function(object){
 	
 	var url = domain('comprobantes/create');
 	var fields = {
 		'rfcEmisor' 			: $('#rfcEmisor').val()
 		,'receptor' 			: $('#receptor').val()
 		,'uuid' 				: $('#uuid').val()
 		,'importe' 				: $('#importe').val()
 		,'fechaDesde' 		    : $('#fechaDesde').val()
        ,'fechaHasta'           : $('#fechaHasta').val()
        ,'id_proyecto'          : $('#proyecto').val()
        ,'id_subproyecto'       : $('#subproyectos').val()
 		,'id_viaje' 			: $('#viajes').val()
 	}
    
    $('#seccion_tabla_cfdi').hide();
    var validation = ['proyecto','subproyectos','viajes'];
    if(validacion_fields(validation) == "error"){return;};
    $(object).attr('disabled',true);
    $('#imagenqr').attr('disabled',true);
 	create_register(url,fields,function(json){
 		$('#seccion_tabla_cfdi').show('slow');
        $(object).removeAttr('disabled');
        var data = [];
        var conceptos = [];
        var count = 0;
        
        for (var i = 0; i < json.result.length; i++) {
            //var button = '<button type="button" uuid="'+json.result[i].uuid+'" class="btn btn-info" onclick="conceptos_detalles(this)">Detalles</button>';
            var button = '<button type="button" uuid="'+json.result[i].uuid+'" class="btn btn-info" onclick="conceptos_detalles(this)">Detalles</button>';
            data[count] = {
                'emisorRfc'          : json.result[i].emisorRfc
                ,'emisorNombre'      : json.result[i].emisorNombre
                ,'uuid'              : json.result[i].uuid
                ,'total'             : json.result[i].total
                ,'detalles'          : button
            }
            count++;

        }
        data_table_general(data,'tabla_cfdi');

 	},function(json){
 		//error
        $(object).removeAttr('disabled');
        $('#imagenqr').removeAttr('disabled');
 	});

 }
/**
 *Funcion para agregar una nota de credito.
 *@return void
 */
 nocfdi_comprobante = function(){
    
    var url = domain('comprobantes/create');
    var fields = {
        
        'conceptos'             : $('#conceptos').val()
        ,'id_etiqueta'          : $('#id_etiqueta').val()
        ,'importe'              : $('#importe').val()
        ,'comentarios'          : $('#comentarios').val()
        ,'fecha'                : $('#fecha').val()
        ,'path_url_img'         : $('#path_url_img').val()
    }

    create_register(url,fields,function(json){
        
    },function(json){
        //error

    });

 }
 /**
  *Se hace la creacion de la tabla en el div correspondiente
  *@access public
  *@param array [description]
  *@return json
  */
  conceptos_detalles = function( object ){

    var url = domain('comprobantes/create');
    var fields = {'uuid' : $(object).attr('uuid') }
    //$('#conceptos_detalles').hide();
    create_register(url,fields,function(json){
        //$('#conceptos_detalles').show('slow');
        var table = '';
        var conceptos = [];
        var count = 0;
        for (var i = 0; i < json.result.length; i++) {

            for (var j = 0; j < json.result[i].conceptos.length; j++) {
                
                conceptos[j] = {
                    'claveProdServ'         : (json.result[i].conceptos[j].claveProdServ != null)? json.result[i].conceptos[j].claveProdServ :""
                    ,'noIdentificacion'     : (json.result[i].conceptos[j].noIdentificacion != null)? json.result[i].conceptos[j].noIdentificacion :""
                    ,'claveUnidad'          : (json.result[i].conceptos[j].claveUnidad != null)? json.result[i].conceptos[j].claveUnidad :""
                    ,'descuento'            : (json.result[i].conceptos[j].descuento != null)? json.result[i].conceptos[j].descuento :""
                    ,'cantidad'             : (json.result[i].conceptos[j].cantidad != null)? json.result[i].conceptos[j].cantidad :""
                    ,'unidad'               : (json.result[i].conceptos[j].unidad != null)? json.result[i].conceptos[j].unidad :""
                    ,'descripcion'          : (json.result[i].conceptos[j].descripcion != null)? json.result[i].conceptos[j].descripcion :""
                    ,'valorUnitario'        : (json.result[i].conceptos[j].valorUnitario != null)? json.result[i].conceptos[j].valorUnitario :""
                    ,'importe'              : (json.result[i].conceptos[j].importe != null)? json.result[i].conceptos[j].importe :""
                    ,'asignar'              : '<button type="button" class="btn btn-success" >Asignar Etiqueta</button>'
                }

            }

            count++;
        }
        
        table += '<div class="container table-responsive" id="conceptos_detalles" style="overflow-y: auto;  height: 450px;">';
            table += '<table class="table table-responsive" id="tabla_conceptos">';
                table += '<thead>';
                    table += '<tr>';
                        table += '<th>PRODUCTO</th>';
                        table += '<th>No IDENTIFICACION</th>';
                        table += '<th>CLAVE UNIDAD</th>';
                        table += '<th>DESCUENTO</th>';
                        table += '<th>CANTIDAD</th>';
                        table += '<th>UNIDAD</th>';
                        table += '<th>DESCRIPCION</th>';
                        table += '<th>VALOR UNITARIO</th>';
                        table += '<th>IMPORTE</th>';
                        table += '<th></th>';
                    table += '</tr>';
                table += '</thead>';
                table += '<tbody></tbody>';
            table += '</table>';
        table += '</div>';
        $.fancybox.open( table );
        data_table_general(conceptos,'tabla_conceptos');

    },function(json){
        //error
    });

  }
/**
 *Funcion para mostrar en un modal donde se subira el QR
 *@access public
 *@param 
 *@return void
 */
 upload_img = function( object ){
    
    //$('#content_qr').show('slow');
    /*var html = '';
        html += '<div id="mainbody">';
            html += '<div class="container">';
            html += '<img class="selector" id="webcamimg" src="vid.png" onclick="setwebcam()" align="left" />';
            html += '<img class="selector" id="qrimg" src="cam.png" onclick="setimg()" align="right"/>';
            html += '<div id="outdiv"></div>';
            html += '<canvas id="qr-canvas" width="800" height="600"></canvas>';
            html += '<div id="result" width="800" height="100"></div>'
            html += '</div>';
        html += '</div>';

    $.fancybox.open( html );*/

 }
/**
 *Funcion para obtener los subproyectos por medio de un id de proyecto
 *@param
 *@return
 */
 show_subproyecto = function( object ){

        var url = domain('subproyectos/subproyectobyid');
        var fields = {
          'id_proyecto' : $(object).val()
        }
            detalles_register(url,fields,function(json){
                
                $('#subproyectos').html('');
                $('#subproyectos').append('<option value="">--SELECCIONA--</option>');
                for (var i = 0; i < json.result.length; i++) {
                    $('#subproyectos').append('<option value="'+json.result[i].id_subproyecto+'">'+json.result[i].nombre+'</option>');
                }
                $('#subproyectos').removeAttr('disabled');

            },function(json){
                    $('#subproyectos').html('<option value="">--SELECCIONA--</option>');
                    $('#viajes').html('<option value="">--SELECCIONA--</option>');
                    $('#subproyectos').attr('disabled',true);
                    $('#viajes').attr('disabled',true);
            });
  
  }
/**
 *Funcion para obtener los viajes
 *@param
 *@return
 */
   show_viajes = function( object ){ 

        var url = domain('viajes/viajebyid');
        var fields = {
          'id_subproyecto' : $(object).val()
          ,'id_proyecto' : $('#proyecto').val()
        }
        detalles_register(url,fields,function(json){
                
                $('#viajes').html('');
                $('#viajes').append('<option value="">--SELECCIONA--</option>');
                for (var i = 0; i < json.result.length; i++) {
                    $('#viajes').append('<option value="'+json.result[i].id_viaje+'">'+json.result[i].nombre+'</option>');
                }
                $('#viajes').removeAttr('disabled');

            },function(json){
                $('#viajes').html('<option value="">--SELECCIONA--</option>');
                $('#viajes').attr('disabled',true);
            });

  }
