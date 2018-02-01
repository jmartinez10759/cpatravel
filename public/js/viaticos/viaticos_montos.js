$().ready(function(){
	//alert('script viaticos');
});
	/**
	 *Funcion para la consulta de los viaticos mediante sus id_detalle
	 *@param  id_detalle [description]
	 *@return void
	 */
	 function details( id_detalle ){

	 	var url = domain('viaticos/detalles');
	 	var fields = {
	 		'id_detalle'  :	 id_detalle
	 	};
	 	//se manda a llamar la funcion para obtener los registros
	 	detalles_register(url,fields,function(json){

 			$('#seccion_viatico_table').hide('slow');
 			$('#seccion_viatico_form').show('slow');
 			get_values(json.result_viaticos);
 			get_values(json.result_montos);
 			 $( "#viatico_costo_unitario" ).blur();
 			 $('#id_detalle').val(id_detalle);
 			 $('#save_viaticos_solicitud').hide('slow');
 			 $('#actualizar_viaticos').show('slow');
 			for (var i = 0; i < json.result_montos.length; i++) {
 				$('#monto_tipo_solicitud').val(json.result_montos[i].monto_tipo_solicitud);
 				if (json.result_montos[i].monto_tipo_pago == "Cheques") { $('#forma_pago_1').val( json.result_montos[i].monto_importe )}
 				if (json.result_montos[i].monto_tipo_pago == "Debito") { $('#forma_pago_2').val( json.result_montos[i].monto_importe ) }
 				if (json.result_montos[i].monto_tipo_pago == "Credito") { $('#forma_pago_3').val( json.result_montos[i].monto_importe ) }
 				if (json.result_montos[i].monto_tipo_pago == "Efectivo") { $('#forma_pago_4').val( json.result_montos[i].monto_importe ) }
 				if (json.result_montos[i].monto_tipo_pago == "Corporativa") { $('#forma_pago_5').val( json.result_montos[i].monto_importe ) }
 			}
 			//se realiza la actualizacion del monto parcial..
 			var importe_emp_total 	= $('#importe_emp_total').val();
	 		var total_importe 		= $('#total_importe').val();
 	 		var total_parcial 		= parseFloat( importe_emp_total - total_importe );
            $('#importe_emp_total').val(total_parcial);

	 	});

	 }
	 /**
	 *Funcion para borrar el viatico con su monto creado
	 *@param  id_detalle [description]
	 *@return void
	 */
	 function destroy( id_detalle ){
		
		var url = domain('viaticos/borrar'); //ViaticoDetalleWebController@borrar
		var fields = {'id_detalle' : id_detalle, 'id_solicitud' : $('#id_solicitud').val() };
		delete_register(url,fields,function(json){
			detail_solicitud(fields.id_solicitud);
		});

	 }
	/**
	 *Funcion para actualizar datos de los viaticos
	 *@param  id_detalle [description]
	 *@return void
	 */
	 function actualizar(){

	 		var id_viatico 				= $('#id_viatico').val();
            var total_importe 			= $('#total_importe').val();
            var importe_emp_total       = $('#importe_emp_total').val();
            var importe_emp_nal         = $('#importe_emp_nal').val();
            var importe_emp_ext         = $('#importe_emp_ext').val();
            var monto_tipo_solicitud    = $('#monto_tipo_solicitud').val();
            var inputs 					= [1,2,3,4,5]; //1 cheques| 2 debito | 3 Credito | 4 Efectivo |5 corporativa
            var monto_tipo_pago 		= [];
            var monto_importe 			= [];
            var conteo 					= 0;
            var id_solicitud 			= $('#id_solicitud').val();

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
                //console.log(monto_importe_total);return;
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

				var url = domain('viaticos/actualizar'); //ViaticoDetalleWebController@actualizar
				var fields = {

					'id_detalle' 					:   $('#id_detalle').val()
					,'id_solicitud' 				:   id_solicitud 
	                ,'id_viatico'                   :   id_viatico
	                ,'monto_tipo_solicitud'         :   $('#monto_tipo_solicitud').val()
	                ,'viatico'                      :   $('#etiqueta_nombre').text() 
	                ,'viatico_cantidad'             :   $('#viatico_cantidad').val()
	                ,'viatico_unidad'               :   $('#viatico_unidad').val()
	                ,'viatico_costo_unitario'       :   $('#viatico_costo_unitario').val()
	                ,'monto_tipo_pago'              :   ( monto_tipo_pago != null )? monto_tipo_pago :"Efectivo"
	                ,'monto_importe'                :   ( monto_importe != null )? monto_importe :0
	                ,'monto_importe_autorizado'     :   ($('#monto_importe_autorizado').val() != null )? $('#monto_importe_autorizado').val() :0

				};
				//se manda a llamar esta funcion para la actualizacion de los monto y viaticos
				update_register(url,fields,function(json){
					$('.btn-default').attr('disabled',false);
                    $('.btn-default').removeClass('hidden');
					detail_solicitud(fields.id_solicitud);
				});

	 }
