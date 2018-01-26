$().ready(function(){
	

	$("#datepicker_inicio").datepicker({
        minDate: 0,
        onSelect: function(selected,event) {

            var fecha_fin = $('#datepicker_fin').val().trim();
            var fecha_inicio = $(this).val().trim();
            if( fecha_inicio != null && fecha_fin != null ){
                var dias = restaFechas(fecha_inicio,fecha_fin);
                $('.numero-dias').text( dias );
                $('.numero-dias-txt').val( dias );
                if (dias < 0) {
                    pnotify('Fechas Incorrectas','La fecha inicial no debe ser mayor a la final','error');
                    return;
                }

            }
        },
        dateFormat: 'dd-mm-yy'
    });

    $("#datepicker_fin").datepicker({
        minDate: 0,
        onSelect: function(selected,event) {
            var fecha_inicio = $('#datepicker_inicio').val().trim();
            var fecha_fin = $(this).val().trim();
            if( fecha_inicio != null &&  fecha_fin != null ) {
                var dias = restaFechas(fecha_inicio,fecha_fin);
                $('.numero-dias').text( dias );
                $('.numero-dias-txt').val( dias );
                if (dias < 0) {
                    pnotify('Fechas Incorrectas','La fecha inicial no debe ser mayor a la final','error');
                    return;
                }
            }
        },
        dateFormat: 'dd-mm-yy'
    });




});

/**
 *Funcion para obtener los subproyectos por medio de un id de proyecto
 *@param
 *@return
 */
  function show_subproyecto(object){

    var url = domain('subproyectos/subproyectobyid');
    var fields = {
      'id_proyecto' : $(object).val()
    }
        detalles_register(url,fields,function(json){
            
            $('#id_subproyecto').html('');
            $('#id_subproyecto').append('<option value="">--SELECCIONA--</option>');
            for (var i = 0; i < json.result.length; i++) {
                $('#id_subproyecto').append('<option value="'+json.result[i].id_subproyecto+'">'+json.result[i].nombre+'</option>');
            }
            $('#id_subproyecto').removeAttr('disabled');

        },function(json){
                $('#id_subproyecto').html('<option value="">--SELECCIONA--</option>');
                $('#id_viajes').html('<option value="">--SELECCIONA--</option>');
                $('#id_subproyecto').attr('disabled',true);
                $('#id_viajes').attr('disabled',true);
        });
  
  }
/**
 *Funcion para obtener los viajes
 *@param
 *@return
 */
  function show_viajes(object){ 

    var url = domain('viajes/viajebyid');
    var fields = {
      'id_subproyecto' : $(object).val()
      ,'id_proyecto' : $('#id_proyecto').val()
    }
    detalles_register(url,fields,function(json){
            
            $('#id_viaje').html('');
            $('#id_viaje').append('<option value="">--SELECCIONA--</option>');
            for (var i = 0; i < json.result.length; i++) {
                $('#id_viaje').append('<option value="'+json.result[i].id_viaje+'">'+json.result[i].nombre+'</option>');
            }
            $('#id_viaje').removeAttr('disabled');

        },function(json){
            $('#id_viaje').html('<option value="">--SELECCIONA--</option>');
            $('#id_viaje').attr('disabled',true);
        });

  }