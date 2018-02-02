$().ready(function(){
    //se manda a llamar esta funcion para hacer la validacion si existe el id_solicitud realiza una consulta en su 
    //defecto arroja el formulario de la solicitud
    detalles_solicitud();
    sumDays();

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

    $('#id_destino_inicial').val('México');
    $('#id_destino_final').val('México');
    $('#hora_salida').val('00:00');
    $('#hora_final').val('00:00');
    $('#user').multipleSelect();

});
    /**
     *Funcion para sumar las fechas al cargar el formulario
     *@access public
     *@return
     */
    function sumDays(){

        var fecha_fin= $('#datepicker_fin').val().trim();
        var fecha_inicio = $('#datepicker_inicio').val().trim();
        if( fecha_inicio != null && fecha_fin != null){
            var dias = restaFechas(fecha_inicio,fecha_fin);
            if (dias < 0) {
                buildSweetAlert('Fechas Incorrectas','La fecha inicial no debe ser mayor a la final','error');
                return;
            }
            $('.numero-dias').text( dias );
            $('.numero-dias-txt').val( dias );
        }

    }
    /**
     *Funcion para obtener los subproyectos por medio de un id de proyecto
     *@param
     *@return
     */
  function show_subproyecto(object){
    ///subproyectos/subproyectobyid
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
  function show_viajes(object){ 
    //viajes/viajebyid
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
    /**
     *Funcion que carga la vista para crear el formulario de los viaticos
     *@access public
     *@param object [description]
     *@return html
     */
    function select_viatico( object ){

        var url = domain('viaticos/consulta'); //App\Http\Controllers\Web\ViaticoDetalleWebController@main
        var fields = {
            'id_viatico'      : $(object).attr('id')
            ,'id_solicitud'    : $("#id_solicitud").val()
        }
        console.log( 'Datos enviados al controller : '+url );
        console.log(fields);
        //se manda a llamar una funcion donde se muestran los detalles.
        detalles_register(url,fields,function(json){

            console.log(json);
                $('#seccion_viaticos').show('slow');
                $('#seccion_solicitud').hide('slow');
                $('#etiqueta_img').html('');
                $('#etiqueta_img').html('<img src="'+json.etiquetas.etiqueta_img+'" width="150px" height="150px">');
                $('#etiqueta_nombre').text( json.etiquetas.etiqueta_nombre );
                $('#viatico_costo_unitario').val( json.etiquetas.importe_emp_nal );
                $('#importe_emp_ext').val( json.etiquetas.importe_emp_ext );
                $('#importe_emp_nal').val( json.etiquetas.importe_emp_nal );
                $('#importe_emp_total').val(0);
                $('#name_viatico').text( json.etiquetas.etiqueta_nombre );
                $('#id_viatico').val( json.etiquetas.id_etiqueta );
                $('.btn-default').attr( 'disabled',true );
                $('.btn-default').addClass('hidden')
                $('#save_viaticos_solicitud').show('slow');
                $('#actualizar_viaticos').hide('slow');
                clean_seccion_viatico(json.etiquetas.importe_emp_nal);
                if ( json.viaticos != null ) {
                    console.log(json.viaticos);
                    //se crea una tabla dinamica para visualizar los viaticos agrupados.
                    $('#table_viaticos_temporal tbody').html('');
                    var viaticos = [];
                    var total_importe_viatico = 0;
                    for (var i = 0; i < json.viaticos.length; i++) {
                            var monto_total_importe = parseFloat( json.viaticos[i].viatico_cantidad * json.viaticos[i].viatico_unidad * json.viaticos[i].viatico_costo_unitario);
                             viaticos[i] = {
                                'viatico_nombre'            : json.viaticos[i].viatico_nombre
                                ,'viatico_cantidad'         : json.viaticos[i].viatico_cantidad
                                ,'viatico_unidad'           : json.viaticos[i].viatico_unidad
                                ,'viatico_costo_unitario'   : json.viaticos[i].viatico_costo_unitario
                                ,'monto_total_importe'      : monto_total_importe
                                ,'edit' : '<button class="btn btn-info"  id="'+json.viaticos[i].id_detalle+'" onclick="details('+json.viaticos[i].id_detalle+')">Detalles</button>'
                                ,'borrar' : '<button class="btn btn-danger"id="'+json.viaticos[i].id_detalle+'"  onclick="destroy('+json.viaticos[i].id_detalle+')">Borrar</button>' 
                            }
                            total_importe_viatico = parseFloat( monto_total_importe + total_importe_viatico);
                    }
                    $('#importe_emp_total').val(total_importe_viatico);
                    data_table_general(viaticos,'table_viaticos_temporal');

                }

        });

    }
    /**
     *Funcion limpiar la seccion de los viaticos
     *@access public
     *@param object [description]
     *@return htmltotal_importe
     */
    function clean_seccion_viatico(viatico_costo_unitario){

        var inputs = [1,2,3,4,5];
        var viatico_costo_unitario = (viatico_costo_unitario)?viatico_costo_unitario:1;
        $('#viatico_cantidad').val(1);
        $('#viatico_costo_unitario').val(viatico_costo_unitario);
        $('#viatico_unidad').val(1);
        $('#total_importe').val(1);
        $('#id_detalle').val('');
        $('#monto_tipo_solicitud').val('Nacional');
        totalViaticos();
        for (var i = 0; i < inputs.length; i++) {
            $('#forma_pago_'+inputs[i]).val(0);
        }

    }
    /**
     *Funcion que carga la vista para crear el formulario de los viaticos
     *@access public
     *@param object [description]
     *@return html
    */
    function back_seccion( object ){

        
        if (object.viaticos == "seccion_viaticos") {
            //se realiza una consulta de los viaticos con su id_solicitud para utilizar el servicio creado
            /*var url = domain('solicitud/consulta');
            var fields = { 'id_solicitud' : object.id_solicitud }

            console.log( 'Datos enviados al controller : '+url );
            console.log(fields);
            create_register(url,fields,function(json){

                $('#save_solicitud').hide('slow');
                $('#send_solicitudes').removeAttr('disabled');
                consulta_solicitud(json.result[0]);

            });*/

        }else{
            
            $('#seccion_solicitud').show('slow');
            $('#seccion_viaticos').hide('slow');
            $('.btn-default').attr('disabled',false);
            //$('.btn-default').addClass('hidden');
            $('.btn-default').removeClass('hidden');
            $('#seccion_viatico_form').hide('slow');
            $('#seccion_viatico_table').show('slow');
            clean_seccion_viatico();

        }   

    }
    /**
     *Funcion donde se parsean los datos en sus respectivos campos en la parte de solicitud
     *@param json [description]
     *@return void
     */
     function seccion_solicitud_parse( json ){

            $('#proyecto').val(json.id_proyecto);
            $('#subproyectos').val(json.id_subproyecto);
            $('#viajes').val(json.id_viaje);
            $('#id_destino_final').val(json.solicitud_destino_final);
            $('#id_destino_inicial').val(json.solicitud_destino_inicio);
            $('#datepicker_fin').val(json.solicitud_fecha_fin);
            $('#datepicker_inicio').val(json.solicitud_fecha_inicio);
            $('#hora_final').val(json.solicitud_horario_fin);
            $('#hora_salida').val(json.solicitud_horario_inicio);
            $('.total_importe').text('$'+number_format(json.total,2));
            //$('#importe_emp_total').val( json.total );

            $('#proyecto').attr('disabled',true);
            $('#subproyectos').attr('disabled',true);
            $('#viajes').attr('disabled',true);
            $('#id_destino_final').attr('disabled',true);
            $('#id_destino_inicial').attr('disabled',true);
            $('#datepicker_fin').attr('disabled',true);
            $('#datepicker_inicio').attr('disabled',true);
            $('#hora_final').attr('disabled',true);
            $('#hora_salida').attr('disabled',true);
            $('#user').attr('disabled',true);

     }
     /**
     *Funcion que cambia dinamicamente el tipo de solicitud 
     *@access public
     *@param object [description]
     *@return html
     */
    function change_tipo_solicitud(object){

        var tipo_solicitud = $(object).val();
        $(".monto_tipo_solicitud").text("");
        $(".monto_tipo_solicitud").text(tipo_solicitud);
        if (tipo_solicitud == "Nacional") {
            $('#viatico_costo_unitario').val( $('#importe_emp_nal').val() );
        }else{
            $('#viatico_costo_unitario').val( $('#importe_emp_ext').val() );

        }
        totalViaticos();

    }
     /**
     *Funcion para calcular el costo del importe
     *@access public
     *@param object [description]
     *@return html
     */
    function totalViaticos( object ){

        var cantidad = $('#viatico_cantidad').val();
        var costo_unitario = $("#viatico_costo_unitario").val();
        var unidad = $('#viatico_unidad').val();
        var total = parseFloat( parseFloat(costo_unitario) * parseFloat( cantidad ) * parseFloat(unidad) );
        $('.total_importe').val( total );  
        //$('.total_importe').text(total);

    }
    /**
     *Funcion para guardar la informacion de la solicitud solamente
     *@access public
     *@param object [description]
     *@return void
     */
    function save_solicitud( object ){

            //se manda a llamar una funcion para verificar si estan los datos cargados correctamente
                validation = ['datepicker_inicio'
                              ,'datepicker_fin'
                              ,'hora_salida'
                              ,'hora_final'
                              ,'id_destino_inicial'
                              ,'id_destino_final'
                              ,'proyecto'
                              ,'subproyectos'
                              ,'viajes'
                              ];

                if(validacion_fields(validation) == "error"){return;};
                if ( $('.numero-dias').text() < 0 ) {
                    buildSweetAlert('Fechas Incorrectas','La fecha inicial no debe ser mayor a la final','error');
                    return;
                }   

                var url = domain('solicitud/guardar');
                var fields = {
                    'solicitud_fecha_inicio'       : $("#datepicker_inicio").val()
                    ,'solicitud_fecha_fin'          : $("#datepicker_fin").val()
                    ,'solicitud_horario_inicio'     : $("#hora_salida").val()
                    ,'solicitud_horario_fin'        : $("#hora_final").val()
                    ,'solicitud_destino_inicio'     : $("#id_destino_inicial").val()
                    ,'solicitud_destino_final'      : $("#id_destino_final").val()
                    ,'id_proyecto'                  : $("#proyecto").val()
                    ,'id_subproyecto'               : $("#subproyectos").val()
                    ,'id_viaje'                     : $("#viajes").val()
                    ,'estatus'                      : "Pendiente"
                    ,'acompanantes'                 : $('#user').val()
                };
                console.log("Seccion de guardar la solicitud en la url: "+url );
                console.log(fields);

                create_register(url,fields,function(json){
                    $('#id_solicitud').val(json.result);
                    detail_solicitud(json.result);
                });

    }
    /**
     *Se crea una funcion para la creacion de los viaticos, solicitudes y acompañantes
     *@return json
     */
     function save_viaticos_solicitud(){

            //se realiza la validacion de los campos.
            validation = [
                           'viatico_cantidad'
                          ,'viatico_unidad'
                          ,'viatico_costo_unitario'
                          ,'total_importe'
                          ,'proyecto'
                          ,'subproyectos'
                          ,'viajes'
                        ];

            if(validacion_fields(validation) == "error"){return;};

            var id_viatico              = $('#id_viatico').val();
            var total_importe           = $('#total_importe').val();
            var importe_emp_total       = $('#importe_emp_total').val();
            var importe_emp_nal         = $('#importe_emp_nal').val();
            var importe_emp_ext         = $('#importe_emp_ext').val();
            var monto_tipo_solicitud    = $('#monto_tipo_solicitud').val();
            var inputs = [1,2,3,4,5];   //1 cheques| 2 debito | 3 Credito | 4 Efectivo |5 corporativa 
            var monto_tipo_pago = [];
            var monto_importe = [];
            var conteo = 0;
            var id_solicitud = $('#id_solicitud').val();
            for (var i = 0; i < inputs.length; i++) {

                if ( $('#forma_pago_'+inputs[i]).val() > 0 || $('#forma_pago_'+inputs[i]).val() != "" ) {
                  monto_tipo_pago[conteo] =  $('#forma_pago_'+inputs[i]).attr('monto_tipo_pago');
                  monto_importe[conteo] = $('#forma_pago_'+inputs[i]).val();
                  conteo++;

                }

            }
            var monto_total_viatico = 0;
            for (var i = 0; i < monto_importe.length; i++) {
                monto_total_viatico += parseFloat( monto_importe[i] );
            }
             //se hace la validacion de las cantidades 
                if ( total_importe != monto_total_viatico ) {

                    buildSweetAlert(
                      'Diferencia de Cantidades'
                      ,'El total no concuerda con el monto añadido, faltante: '+parseFloat(total_importe - monto_total_viatico  )
                      ,'error'
                      );
                    return;
                }
                
                var monto_importe_total = parseFloat( parseFloat(total_importe) + parseFloat(importe_emp_total) );

                if (monto_tipo_solicitud == "Nacional") {
                    
                    if ( monto_importe_total > importe_emp_nal ) {

                        pnotify(
                          'Monto mayor al autorizado'
                          ,'El total excede con el monto del viatico: '+parseFloat(monto_importe_total - importe_emp_nal  )
                          ,'error'
                          );
                        return;
                    }

                }
                if (monto_tipo_solicitud == "Extranjero") {
                    
                    if ( monto_importe_total > importe_emp_ext ) {

                        pnotify(
                          'Monto mayor al autorizado'
                          ,'El total excede con el monto del viatico: '+parseFloat(monto_importe_total - importe_emp_ext  )
                          ,'error'
                          );
                        return;
                    }

                }
            //se crea un objeto para mandarlo por ajax al controller
            var url = domain('solicitud/save');
            var fields = {

                'solicitud_fecha_inicio'        :   $("#datepicker_inicio").val()
                ,'solicitud_fecha_fin'          :   $("#datepicker_fin").val()
                ,'solicitud_horario_inicio'     :   $("#hora_salida").val()
                ,'solicitud_horario_fin'        :   $("#hora_final").val()
                ,'solicitud_destino_inicio'     :   $("#id_destino_inicial").val()
                ,'solicitud_destino_final'      :   $("#id_destino_final").val()
                ,'id_proyecto'                  :   $("#proyecto").val()
                ,'id_subproyecto'               :   $("#subproyectos").val()
                ,'id_viaje'                     :   $("#viajes").val()
                ,'estatus'                      :   "Pendiente"
                ,'acompanantes'                 :   $('#user').val()
                ,'id_solicitud'                 :   id_solicitud
                ,'id_viatico'                   :   $('#id_viatico').val()
                ,'monto_tipo_solicitud'         :   $('#monto_tipo_solicitud').val()
                ,'viatico'                      :   $('#etiqueta_nombre').text() 
                ,'viatico_cantidad'             :   $('#viatico_cantidad').val()
                ,'viatico_unidad'               :   $('#viatico_unidad').val()
                ,'viatico_costo_unitario'       :   $('#viatico_costo_unitario').val()
                ,'monto_tipo_pago'              :   ( monto_tipo_pago != null )? monto_tipo_pago :"Efectivo"
                ,'monto_importe'                :   ( monto_importe != null )? monto_importe :0
                ,'monto_importe_autorizado'     :   ($('#monto_importe_autorizado').val() != null )? $('#monto_importe_autorizado').val() :0


            }
                console.log('Datos enviados al controller : '+url);
                console.log(fields);
                //se manda a llamar la funcion de creacion del archivo master.js
                create_register(url,fields,function(json){

                    var seccion = {
                                'viaticos'          : 'seccion_viaticos'
                                ,'id_solicitud'     :  (id_solicitud)? id_solicitud :json.result.solicitud.id_solicitud
                            }
                    console.log(seccion.id_solicitud);
                    $('.btn-default').attr('disabled',false);
                    $('.btn-default').removeClass('hidden');
                    detail_solicitud( seccion.id_solicitud );

                });

     }
    /**
     *Funcion para mostrar los datos de la solicitud
     *@access public
     *@param object [description]
     *@return void
     */
    function show_form_viaticos(){

        $('#seccion_viatico_form').show('slow');
        $('#seccion_viatico_table').hide('slow');

    }
  /**
   *Funcion para obtener los detalles y poder poblar los campos al momento de dar click desde el grid de solicitudes
   *@return void
   */  
   function detalles_solicitud(){

        var id_solicitud = $('#id_solicitud').val();
        //se crea la consulta de la solicitud
        if ( id_solicitud ) {
            
            var url = domain('solicitud/consulta');
            var fields = { 'id_solicitud' : id_solicitud }
            console.log( 'Datos enviados al controller : '+url );
            console.log(fields);
            //se realiza la 
            detalles_register(url,fields,function(json){

                $('#save_solicitud').hide('slow');
                $('#send_solicitudes').removeAttr('disabled');
                $('#send_solicitudes').show('slow');
                parser_data_solicitud( json.result );

            });

        }

   }
   /**
    *Funcion de Jquery para parsear los datos en su campo
    *@param json [description]
    *@json
    */
    function parser_data_solicitud( json ){

        //se cargan la parte de solicitud en sus respectivos campos
        get_values(json.solicitud);
        seccion_solicitud_parse(json.solicitud);
        //se parsean los datos de viaticos para crear la tabla dinamica de viaticos
        data_table_general(json.viaticos,'table_body_concepto');
        //se parsean los datos de los montos en sus respectivos formas de pago y nacional y/o extranjero
        seccion_parser_montos(json.montos);
        //seccion de los acompanantes
        $('#acompanantes').text(json.acompanantes);
        //realiza la suma despues de cargar los datos de la solicitud.
        sumDays();

    }
     /**
     *Funcion en jquery para parsear los datos de los montos
     *@param json [description]
     *@return json
     */
    function seccion_parser_montos( json ){

        $.each(json,function(key,result){
            console.log(result);
            if ( result.monto_tipo_solicitud == "Nacional" ) {

                if (result.monto_tipo_pago == "Cheques") {
                    $('#tr_solicitados_monto_nacional_1').val( result.monto_viatico_total );
                }
                if (result.monto_tipo_pago == "Debito") {
                    $('#tr_solicitados_monto_nacional_2').val( result.monto_viatico_total );
                }
                if (result.monto_tipo_pago == "Credito") {
                    $('#tr_solicitados_monto_nacional_3').val( result.monto_viatico_total );
                }
                if (result.monto_tipo_pago == "Efectivo") {
                    $('#tr_solicitados_monto_nacional_4').val( result.monto_viatico_total );
                }
                if (result.monto_tipo_pago == "Corporativa") {
                    $('#tr_solicitados_monto_nacional_5').val( result.monto_viatico_total );
                }

            }else if( result.monto_tipo_solicitud == "Extranjero" ){

                if (result.monto_tipo_pago == "Cheques") {
                    $('#tr_solicitados_monto_extranjero_1').val( result.monto_viatico_total );
                }
                if (result.monto_tipo_pago == "Debito") {
                    $('#tr_solicitados_monto_extranjero_2').val( result.monto_viatico_total );
                }
                if (result.monto_tipo_pago == "Credito") {
                    $('#tr_solicitados_monto_extranjero_3').val( result.monto_viatico_total );
                }
                if (result.monto_tipo_pago == "Efectivo") {
                    $('#tr_solicitados_monto_extranjero_4').val( result.monto_viatico_total );
                }
                if (result.monto_tipo_pago == "Corporativa") {
                    $('#tr_solicitados_monto_extranjero_5').val( result.monto_viatico_total );
                }
                

            }

        });

    }
