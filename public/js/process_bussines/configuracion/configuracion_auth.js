$().ready(function(){

});
/**
 *Funcion para guradar las autorizaciones 
 *@access public
 *@return json
 */
 configuracion_auth = function(){

 	var auth = [];
	var empleado_group= [];
	var i=0;
	var j=0;
	var importe = $("#desde").val()+"|"+$("#hasta").val();
	$('#autorizador_empleado').find('li').each(function(){

		var id_empleado = $(this).attr('id');
		var nombre = $(this).attr('nombre'); 
		var correo = $(this).attr('correo');
		auth[i] = { 
			'id_empleado': id_empleado
			,'nombre'	 : nombre
			,'correo'    : correo
		};
		i++;
	});

	$('#group_empleados').find('li').each(function(){

		var id_empleado = $(this).attr('id');
		var nombre = $(this).attr('nombre'); 
		var correo = $(this).attr('correo');
		empleado_group[j] = { 
			'id_empleado': id_empleado
			,'nombre'	 : nombre
			,'correo'    : correo
		};
		j++;
	});
	
	var url    = domain('configuracion/guardar');
	var fields = {
		 'importe' 			: importe
		,'autorizadores'	: auth 
		,'empleados' 		: empleado_group
	};
	/*debuger(fields);
	return;*/
	create_register(url,fields,function(json){
		carga_vista_html('configuracion','business/process');
	},function(json){
		
	});


 }
 /**
  *Se crea una funcion para obtener los autorizadores cada vez que se pasen al div de autorizadores.
  *@access public 
  *@return void
  */
  combo_autorizador = function (){

  	var empleados = [];
	var i=0;
	$('#autorizadores').find('li').each(function(){
		var id_empleado = $(this).attr('id');
		var nombre = $(this).attr('nombre'); 
		var correo = $(this).attr('correo');
		empleados[i] = { 
			'id_empleado': id_empleado
			,'nombre'	 : nombre
			,'correo'    : correo
		};
		i++;
	});
	var select = '<select id="id_autorizadores" class="form-control" onclick="cambio_autorizador()">'; 
	for (var i = 0; i < empleados.length; i++) {
		select += '<option value="'+empleados[i].id_empleado+'|'+empleados[i].correo+'">'+empleados[i].nombre+'</option>';
	}
	select += '</select>';
	$('#autorizador').html(select);

  }
  /**
   *Funcion para la creacion de los bloques de los empleados
   *@access public 
   *@return void
   */
   cambio_autorizador = function(){

   		alert();
   		

   }
   /**
    *Funcion habilitar la pantalla ya cargando los datos en un json y poder parsearlos correctamente
    *@access public
    *@param 
    *@return void
    */
    group_autorizadores = function(){

    	$('#autorizadores_auth').show('slow');
    	$('#group_autorizadores').hide();

    	var desde = $('#desde').val();
    	var hasta =  $('#hasta').val();
    	var operador = $('#operador').val();
    	var grupo = desde+" "+operador+" "+hasta;
    	var select = "";
    	select += "<select id='combo_group' class=''>";
    		select += "<option value='"+grupo+"'> Grupo-"+grupo+"</option>";
    	select += "</select>";
    	$('#grupo_select').html('');
    	$('#grupo_select').html(select);

    }
    /**
    *Funcion habilitar la pantalla ya cargando los datos en un json y poder parsearlos correctamente
    *@access public
    *@param 
    *@return void
    */
    back_configuracion = function(){

    	$('#autorizadores_auth').hide();
    	$('#group_autorizadores').show('slow');

    }
    /**
  *Se crea una funcion para indicar que elemento se va arrastrar
  *@access public
  *@param e object [description]
  *@return void
  */
	start = function ( e ){
	 	//e.dataTransfer.effecAllowed = 'move'; 
		e.dataTransfer.setData("data", e.target.id);
	}
  /**
   *Se crea una funcion para mover el elemento
   *@access public
   *@param e [description]
   *@return void
   */	
   	drop = function ( ev ){
   		ev.preventDefault();
	    var data = ev.dataTransfer.getData("data");
	    ev.target.appendChild(document.getElementById(data));
   	}
   /**
   	*Funcion para no cortar la ejecucion del script
   	*@access public
   	*@param ev [description]
   	*@return void
   	*/
   	allowDrop = function ( ev ) { 
   		ev.preventDefault(); 
   	}
	/**
	 * Funcion para no desaparacer el elemento arrastrado y que aparezca dos veces en el div.
	 * @access public
	 * @param e [description]
	 * @return void
	 */
	 clonar = function ( ev ){
	 	//var elemento_arrastrado = document.getElementById(e.dataTransfer.getData("data"));
	 	ev.preventDefault();
	    var data = document.getElementById( ev.dataTransfer.getData("data") );
		var data_clon = data.cloneNode( true ); // Se clona el elemento
		ev.target.appendChild( data_clon ); // Se añade el elemento clonado
	 	//$('#').removeAttr('disabled');
		
	 } 

   /**
	*Eliminar el elemento arrastrado a la parte de los autorizadores 
	*@access public
	*@param e [description]
	*@return void
	*/
	eliminar = function( e ){
		$(e).parent().remove();
		/*var data = document.getElementById(e.dataTransfer.getData("data")); // Elemento arrastrado
		data.parentNode.removeChild(data); // Elimina el elemento*/
	}
    
