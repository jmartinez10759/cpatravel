$().ready(function(){
	/*$myLocalStorage.set('id_usuario', $('#id_usuario').val());
	$myLocalStorage.set('token',$('#token').val());*/
})
/**
 *Funcion de jquery donde se realiza la inserccion de datos mmandando la url y los datos a enviar por medio de ajax
 *@param url string [descripcion]
 *@param fields object [description]
 *@return json
 */
 function create_register( url, fields, success, error ){

	 	requestAjaxSend(url,fields,function(json){
	        
	        if (json.success == true) {

	          pnotify("¡Acción Realizada.!",json.message,'success'); 
	          success(json);

	        }else{
	           pnotify("¡Ocurrio un Error!",json.message,'error'); 
	           error(json);
	        }

	    },function(header){
	            header.setRequestHeader("usuario",$('#id_usuario').val());
	            header.setRequestHeader("token", $('#token').val());
	            header.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
	            
	    },false,false,false,"POST",false,false);


 }
 /**
 *Funcion de jquery donde se realiza la consulta de los registros
 *@param url string [descripcion]
 *@param fields object [description]
 *@return json
 */
 function detalles_register( url, fields, success, error ){

	 	requestAjaxSend(url,fields,function(json){
	        
	        if (json.success == true) {

	          //pnotify("¡Acción Realizada.!",json.message,'success'); 
	          success(json);

	        }else{
	           pnotify("¡Ocurrio un Error!",json.message,'error'); 
	           error(json);
	        }

	    },function(header){
	            header.setRequestHeader("usuario",$('#id_usuario').val());
	            header.setRequestHeader("token", $('#token').val());
	            header.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
	            
	    },false,false,false,"GET",false,false);


 }
 /**
 *Funcion de jquery donde se realiza la actualizacion de los registros 
 *@param url string [descripcion]
 *@param fields object [description]
 *@return json
 */
 function update_register( url, fields, success, error ){


 	buildSweetAlertOptions( "¡Actualizar Registro!", "¿Estas Seguro de Realizar esta accion?", function(){

	 	requestAjaxSend(url,fields,function(json){
	        
	        if (json.success == true) {

	          pnotify("¡Acción Realizada.!",json.message,'success'); 
	          success(json);

	        }else{
	           pnotify("¡Ocurrio un Error!",json.message,'error'); 
	           error(json);
	        }

	    },function(header){
	            header.setRequestHeader("usuario",$('#id_usuario').val());
	            header.setRequestHeader("token", $('#token').val());
	            header.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
	            
	    },false,false,false,"POST",false,false);

	 });

 }
 /**
 *Funcion de jquery donde se eliminan los registros
 *@param url string [descripcion]
 *@param fields object [description]
 *@return json
 */
 function delete_register( url, fields, success, error ){

 	buildSweetAlertOptions( "¡Eliminar Registro!", "¿Estas Seguro de Realizar esta accion?", function(){

	 	requestAjaxSend(url,fields,function(json){
	        
	        if (json.success == true) {

	          pnotify("¡Acción Realizada.!",json.message,'success'); 
	          success(json);

	        }else{
	           pnotify("¡Ocurrio un Error!",json.message,'error'); 
	           error(json);
	        }

	    },function(header){
	            header.setRequestHeader("usuario",$('#id_usuario').val());
	            header.setRequestHeader("token", $('#token').val());
	            header.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
	            
	    },false,false,false,"POST",false,false);

    } );

 }
 /**
 *Funcion para la carga de la vista con mas opciones y sus respectivos menus
 *@param url string [description]
 *@return void
 */
 	function openview( path_url ){

        $('#button_back_general').attr('disabled',true);
          //var url = $(object).attr('url');
          var url = domain(path_url);
           requestAjaxSend(url,false,function(json){

	           	  $('#cargador_general').hide();
	              $("#content-view").css('background-color',"#fff");
	              $("#content-view").css('opacity',"0.90");
	              $("#content-view").css('top',"0");
	              $("#content-view").css('left',"0");
	              $("#content-view").css('width',"100%");
	              $("#content-view").css('height',"100%");
	              $("#content-view").css('position',"fixed");
	              $("#content-view").css('z-index',"1040");
	              $('#content-view').css('overflow','scroll');
	              $('#content-view').show('slow');
           		  $('body').css('overflow','hidden');
	              $('#container-views').html(json);

           },function(header){
                header.setRequestHeader("usuario",$('#id_usuario').val());
	            header.setRequestHeader("token", $('#token').val());
                header.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
                cargador_general();
           },false,false,false,'GET',"HTML",false);

 	}

/**
*Funcion para cerrar la ventana por completo
*@param object
*@return void
*/
  function hideview(object){
 		   
       $('#content-view').hide('slow');
  }
/**
 *Funcion para cargar las vistas necesarias html de una platilla
 *@param  object [description]
 *@return void
 */
    function load_views(object){

        $('#button_back_general').attr('disabled',false);
        var url = $(object).attr('url');

        requestAjaxSend(url,false,function(json){
           loader_hide_msj();
           $('#container-views').html('');
           $('#container-views').html(json);
        },function(header){
              header.setRequestHeader("usuario",$('#id_usuario').val());
	          header.setRequestHeader("token", $('#token').val());
              header.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
              loader_msj();
        },false,false,false,'GET',"HTML",false);

    }
  /**
   *Carga la vista html por medio de jquery ajax
   *@param ruta [description]
   *@return html
   */
   function carga_vista_html( ruta, ruta_next ,ruta_back , disabled ){
   	  disabled = (disabled)? true: false;
      $('#button_back_general').attr('disabled',disabled);
      $('#button_back_general').removeAttr('onclick');
      $('#button_back_general').attr('onclick','carga_vista_html("'+ruta_next+'","'+ruta_back+'")');

      var url = domain( ruta );
      var fields = false;

      requestAjaxSend(url,fields,function(json){
           loader_hide_msj();
           $('#container-views').html('');
           $('#container-views').html(json);
        },function(header){
              header.setRequestHeader("usuario",$('#id_usuario').val());
	          header.setRequestHeader("token", $('#token').val());
              header.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
              loader_msj();
        },false,false,false,'GET',"HTML",false);


   }
   /**
    *Funcion para hacer un cargador transparente
    *@return void
    */
    function cargador_general(){

       $("#cargador_general").css('background-color',"#fff");
       $("#cargador_general").css('opacity',"0.40");
       $("#cargador_general").css('top',"0");
       $("#cargador_general").css('left',"0");
       $("#cargador_general").css('width',"100%");
       $("#cargador_general").css('height',"100%");
       $("#cargador_general").css('position',"fixed");
       $("#cargador_general").css('z-index',"21474");
       $('#cargador_general').show();

    }