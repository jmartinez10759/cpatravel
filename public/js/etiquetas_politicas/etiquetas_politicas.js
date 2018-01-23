$().ready(function(){

	$('#button_back_general').removeAttr('onclick');
	$('#button_back_general').attr('onclick','carga_vista_html("policies")');
	var url = domain('politicas/upload');
	upload_file(false,url,1,'.jpg, .png, .ico',function(json){
		$('#etiqueta_img').val(json.url_file);
	});

	$('.etiquetas').click(function(){
		var inputs = [
			'etiqueta_nombre'
			,'etiqueta_descripcion'
			,'etiqueta_tipo'
			,'etiqueta_img'
			,'importe_ded_nal'
			,'importe_ded_ext'
			,'importe_emp_nal'
			,'importe_emp_ext'
			,'id_etiqueta'
			,'id_politica'
		];
		clear_values(inputs);
		//mostrar_elements(['save_politicas'],['update_politicas']);
		$('#img_seccion').html('');
		$('#save_politicas').show('slow');
		$('#update_politicas').hide();
		var etiqueta = $(this).attr('etiqueta');
		if (etiqueta == "predeterminadas") {
			$('#etiqueta_tipo').val('predeterminadas');
		}
		if (etiqueta == "corporativas") {
			$('#etiqueta_tipo').val('corporativas');
		}
		if (etiqueta == "usuario") {
			$('#etiqueta_tipo').val('usuario');
		}


	});
/*
	$('.detalles_etiqueta').click(function(){
		//detalles_etiqueta()
		var id_etiqueta = $(this).children().find('td');
		console.log(id_etiqueta);
	});*/


});

/**
 *Funcion jquery que realiza la inserccion de los datos de las etiquetas y politicas
 *@return json
 */
  function save_politicas(){

	 	var url = domain('politicas/guardar');
	 	var fields = {
	 		'etiqueta_img' 				  :     $('#etiqueta_img').val()
	 		,'etiqueta_nombre'			  : 	$('#etiqueta_nombre').val()
	 		,'etiqueta_descripcion'		  : 	$('#etiqueta_descripcion').val()
	 		,'etiqueta_tipo'			  : 	$('#etiqueta_tipo').val()
	 		,'importe_ded_nal'			  : 	$('#importe_ded_nal').val()
	 		,'importe_ded_ext'			  : 	$('#importe_ded_ext').val()
	 		,'importe_emp_nal'			  : 	$('#importe_emp_nal').val()
	 		,'importe_emp_ext'			  : 	$('#importe_emp_ext').val()

	 	}
	 	var validacion = [
			'etiqueta_nombre'
			,'etiqueta_descripcion'
			,'etiqueta_tipo'
			,'importe_ded_nal'
			,'importe_ded_ext'
			,'importe_emp_nal'
			,'importe_emp_ext'
		];

	 	if(validacion_fields(validacion) == "error"){return;};

	 		create_register(url,fields,function(json){
	 			carga_vista_html('politicas');
	 		});

  }
 /**
  *Funcion para la actualizacion de las etiquetas y politicas
  *@return json
  */
  function update_politicas(){

        var url = domain('politicas/actualizacion');
        var fields = {
            'id_etiqueta'           :   $('#id_etiqueta').val()
          ,'id_politica'            :   $('#id_politica').val()
          ,'etiqueta_img'           :   $('#etiqueta_img').val()
          ,'etiqueta_nombre'        :   $('#etiqueta_nombre').val()
          ,'etiqueta_descripcion'   :   $('#etiqueta_descripcion').val()
          ,'etiqueta_tipo'          :   $('#etiqueta_tipo').val()
          ,'importe_ded_nal'        :   $('#importe_ded_nal').val()
          ,'importe_ded_ext'        :   $('#importe_ded_ext').val()
          ,'importe_emp_nal'        :   $('#importe_emp_nal').val()
          ,'importe_emp_ext'        :   $('#importe_emp_ext').val()

        }
        var validacion = [
	        'etiqueta_nombre'
	        ,'etiqueta_descripcion'
	        ,'etiqueta_tipo'
	        ,'importe_ded_nal'
	        ,'importe_ded_ext'
	        ,'importe_emp_nal'
	        ,'importe_emp_ext'
        ];

        if(validacion_fields(validacion) == "error"){return;};

        update_register(url,fields,function(json){
        	carga_vista_html('politicas');
        });

  }
  /**
  *Funcion para obtener detalles de los viaticos
  @param fields json [description]
  *@return json
  */
  function detalles_etiqueta( fields ){

	    var url = domain('politicas/detalles');
	    detalles_register(url,fields,function(json){
	    	get_values(json.result);
          	$('#save_politicas').hide('slow');
          	$('#update_politicas').show('slow');
          	$('#img_seccion').html('<img src="'+json.result.etiqueta_img+'" width="150px" height="100px">');
	    });

  }
  /**
  *Funcion para eliminar registros
  @param fields json [description]
  *@return json
  */
   function borrar_etiqueta(fields){

   		var url = domain('politicas/eliminar');
   		delete_register(url,fields,function(json){
   			carga_vista_html('politicas');
   		});

   }