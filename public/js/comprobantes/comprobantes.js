$().ready(function(){

    $("#fecha").val( get_actual_date() );

	$("#fechaDesde").datepicker({
        //minDate: 0,
        onSelect: function(selected,event) {

            var fecha_fin = $('#fechaHasta').val().trim();
            var fecha_inicio = $(this).val().trim();
            if( fecha_inicio != null && fecha_fin != null ){
                var dias = restaFechas(fecha_inicio,fecha_fin);
                if (dias < 0) {
                    pnotify('Fechas Incorrectas','La fecha inicial no debe ser mayor a la final','error');
                    $(this).val( get_actual_date() );
                    $(this).parent().parent().addClass('has-error');
                    return;
                }

            }
        },
        dateFormat: 'yy-mm-dd'
    });

    $("#fechaHasta").datepicker({
        //minDate: 0,
        onSelect: function(selected,event) {
            var fecha_inicio = $('#fechaDesde').val().trim();
            var fecha_fin = $(this).val().trim();
            if( fecha_inicio != null &&  fecha_fin != null ) {
                var dias = restaFechas(fecha_inicio,fecha_fin);
                if (dias < 0) {
                    pnotify('Fechas Incorrectas','La fecha inicial no debe ser mayor a la final','error');
                    $("#fechaDesde").val( get_actual_date() );
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
        dateFormat: 'dd-mm-yy'
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
 search_comprobante = function(){
 	
 	var url = domain('comprobantes/create');
 	var fields = {
 		'rfcEmisor' 			: $('#rfcEmisor').val()
 		,'receptor' 			: $('#receptor').val()
 		,'uuid' 				: $('#uuid').val()
 		,'importe' 				: $('#importe').val()
 		,'fechaDesde' 		    : $('#fechaDesde').val()
 		,'fechaHasta' 			: $('#fechaHasta').val()
 	}

    $('#seccion_tabla_cfdi').hide();
 	create_register(url,fields,function(json){
 		$('#seccion_tabla_cfdi').show('slow');
        var data = [];
        var conceptos = [];
        var count = 0;
        
        for (var i = 0; i < json.result.length; i++) {
            //var conceptos = JSON.stringify(json.result[i].conceptos);
            var button = '<button type="button" class="btn btn-info" onclick="conceptos_detalles()">Detalles</button>';
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
  conceptos_detalles = function( uuid ){

    var url = domain('comprobantes/create');
    var fields = {'uuid' : $('#uuid').val() }

    $('#conceptos_detalles').hide();
    create_register(url,fields,function(json){
        $('#conceptos_detalles').show('slow');
        var conceptos = [];
        var count = 0;
        for (var i = 0; i < json.result.length; i++) {

            for (var j = 0; j < json.result[i].conceptos.length; j++) {
                
                conceptos[j] = {
                    'claveProdServ'         : json.result[i].conceptos[j].claveProdServ
                    ,'noIdentificacion'     : json.result[i].conceptos[j].noIdentificacion
                    ,'claveUnidad'          : json.result[i].conceptos[j].claveUnidad
                    ,'descuento'            : json.result[i].conceptos[j].descuento
                    ,'cantidad'             : json.result[i].conceptos[j].cantidad
                    ,'unidad'               : json.result[i].conceptos[j].unidad
                    ,'descripcion'          : json.result[i].conceptos[j].descripcion
                    ,'valorUnitario'        : json.result[i].conceptos[j].valorUnitario
                    ,'importe'              : json.result[i].conceptos[j].importe
                }

            }

                count++;
            }
        
        data_table_general(conceptos,'tabla_conceptos');

    },function(json){
        //error
    });

  }
