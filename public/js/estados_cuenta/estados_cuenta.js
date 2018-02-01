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
    var url_filtro = domain('estadoscuenta/filtros');
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

            detalles_register(url_filtro,fields,function(json){

                var usuarios = [];
                for (var i = 0; i < json.result.length; i++) {
                    
                    usuarios[i] = {
                        ''                      : ""
                        ,'proyecto'                     : json.result[i].proyecto
                        ,'subproyecto'                  : json.result[i].subproyecto
                        ,'viaje'                        : json.result[i].viaje
                        ,'etiqueta_nombre'              : json.result[i].etiqueta_nombre
                        ,'solicitud_fecha_inicio'       : json.result[i].solicitud_fecha_inicio
                    }
                }
                data_table_general(usuarios,'datatable_usuario');
                data_table_general(json.result,'datatable_admin');

            },function(json){
                $('#datatable_usuario tbody').html('');
                $('#datatable_admin tbody').html('');
            });


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
    var url_filtro = domain('estadoscuenta/filtros');
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

            detalles_register(url_filtro,fields,function(json){
                
                var usuarios = [];
                for (var i = 0; i < json.result.length; i++) {
                    
                    usuarios[i] = {
                        ''                      : ""
                        ,'proyecto'                     : json.result[i].proyecto
                        ,'subproyecto'                  : json.result[i].subproyecto
                        ,'viaje'                        : json.result[i].viaje
                        ,'etiqueta_nombre'              : json.result[i].etiqueta_nombre
                        ,'solicitud_fecha_inicio'       : json.result[i].solicitud_fecha_inicio
                    }
                }
                data_table_general(usuarios,'datatable_usuario');
                data_table_general(json.result,'datatable_admin');

            },function(json){
                $('#datatable_usuario tbody').html('');
                $('#datatable_admin tbody').html('');
            });

        },function(json){
            $('#id_viaje').html('<option value="">--SELECCIONA--</option>');
            $('#id_viaje').attr('disabled',true);
        });

  }
/**
 *Funcion para obtener los viajes
 *@param
 *@return
 */
  function data_viajes(object){ 

    var url = domain('estadoscuenta/filtros');
    var fields = {
      'id_viaje'        : $(object).val()
      ,'id_subproyecto' : $('id_subproyecto').val()
      ,'id_proyecto'    : $('#id_proyecto').val()
    }
    detalles_register(url,fields,function(json){

        var usuarios = [];
        for (var i = 0; i < json.result.length; i++) {
            
            usuarios[i] = {
                ''                      : ""
                ,'proyecto'                     : json.result[i].proyecto
                ,'subproyecto'                  : json.result[i].subproyecto
                ,'viaje'                        : json.result[i].viaje
                ,'etiqueta_nombre'              : json.result[i].etiqueta_nombre
                ,'solicitud_fecha_inicio'       : json.result[i].solicitud_fecha_inicio
            }
        }
        data_table_general(usuarios,'datatable_usuario');
        data_table_general(json.result,'datatable_admin');

    },function(json){
        $('#id_viaje').html('<option value="">--SELECCIONA--</option>');
        $('#id_viaje').attr('disabled',true);
    });

  }
/**
 *Funcion para obtener los viajes
 *@param
 *@return
 */
  function etiquetas(object){ 

    var url = domain('estadoscuenta/filtros');
    var fields = {
      'id_etiqueta' : $(object).val()
    }
    detalles_register(url,fields,function(json){

        var usuarios = [];
        for (var i = 0; i < json.result.length; i++) {
            
            usuarios[i] = {
                ''                      : ""
                ,'proyecto'                     : json.result[i].proyecto
                ,'subproyecto'                  : json.result[i].subproyecto
                ,'viaje'                        : json.result[i].viaje
                ,'etiqueta_nombre'              : json.result[i].etiqueta_nombre
                ,'solicitud_fecha_inicio'       : json.result[i].solicitud_fecha_inicio
            }
        }
        data_table_general(usuarios,'datatable_usuario');
        data_table_general(json.result,'datatable_admin');

    },function(json){
        $('#datatable_usuario tbody').html('');
        $('#datatable_admin tbody').html('');
    });

  }
  /**
   *Funcion para la consulta de fechas
   *@return json
   */
   between_fecha = function(){

        var url = domain('estadoscuenta/filtros');
        var fields = {
            'solicitud_fecha_inicio'     :   $('#datepicker_inicio').val()
            ,'solicitud_fecha_fin'       :   $('#datepicker_fin').val()
        }

        detalles_register(url,fields,function(json){

            var usuarios = [];
        for (var i = 0; i < json.result.length; i++) {
            
            usuarios[i] = {
                ''                              : ""
                ,'proyecto'                     : json.result[i].proyecto
                ,'subproyecto'                  : json.result[i].subproyecto
                ,'viaje'                        : json.result[i].viaje
                ,'etiqueta_nombre'              : json.result[i].etiqueta_nombre
                ,'solicitud_fecha_inicio'       : json.result[i].solicitud_fecha_inicio
            }
        }
        data_table_general(usuarios,'datatable_usuario');
        data_table_general(json.result,'datatable_admin');

        },function(json){
            alert('ocurrio un error');
        });



   }

