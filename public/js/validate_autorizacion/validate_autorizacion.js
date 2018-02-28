$().ready(function(){

	suma_montos();

	var nacional  = $('#nacionales').val();
    var extranjero = $('#extranjeros').val();

    if ( nacional == 1 && extranjero == 0) {
        $('#tabla_nacional').show();
        $('#nacional').show();
        $('#tabla_extranjero').hide();
        $('#extranjero').hide();
    }

    if (extranjero == 1 && nacional == 0) {
        $('#tabla_extranjero').show();
        $('#extranjero').show();
        $('#tabla_nacional').hide();
        $('#nacional').hide();
    }

    if (extranjero == 1 && nacional == 1) {
        $('#tabla_extranjero').show();
        $('#extranjero').show();
        $('#tabla_nacional').show();
        $('#nacional').show();
    }

});
/**
 *Funcion para autorizar la solicitud generada
 *@return void
 */
 function autorizaciones(object){

 	var url = domain('autorizacion/enviar');
 	var montos_autorizados_nacional = [];
 	var montos_autorizados_extranjero = [];
 	var estatus = $(object).attr('estatus');
 	var inputs = [1,2,3,4,5];
 	for (var i = 0; i < inputs.length; i++) {
 		montos_autorizados_nacional[i] = $('#tr_autorizado_monto_nacional_'+inputs[i]).val();
 		montos_autorizados_extranjero[i] = $('#tr_autorizado_monto_extranjero_'+inputs[i]).val();
 	}
 	var fields = {
 		'id_solicitud'						: $('#id_solicitud').val()
 		,'montos_autorizados_nacional'   	: montos_autorizados_nacional
 		,'total_nacional' 					: $('#total_nacional').text()
 		,'montos_autorizados_extranjero' 	: montos_autorizados_extranjero
 		,'total_extranjero'					: $('#total_extranjero').text()
 		,'estatus' 							: estatus
 	}

 	create_register(url,fields,function(json){
 		
 		console.log(json);

 	},function(json){

 	});


 }
 /**
  *Funcion para la suma de los montos autorizados y al final dar un resultado final
  *@return double [description]
  */
  function suma_montos(){

  	var inputs = [1,2,3,4,5];
 	var total_nacional = 0;
 	var total_extranjero = 0;

 	for (var i = 0; i < inputs.length; i++) {
 		total_nacional = parseFloat( parseFloat($('#tr_autorizado_monto_nacional_'+inputs[i]).val() ) + parseFloat(total_nacional) );
 		total_extranjero = parseFloat( parseFloat($('#tr_autorizado_monto_extranjero_'+inputs[i]).val() ) + parseFloat(total_extranjero) );
 	}

 	$('#total_nacional').text(number_format(total_nacional,2));
  $('#total_extranjero').text( number_format(total_extranjero,2) );
 	$('.total_importe_autorizado').text( number_format(total_nacional,2) );


  }

