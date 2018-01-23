$().ready(function(){

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
	            header.setRequestHeader("usuario",$myLocalStorage.get('id_usuario'));
	            header.setRequestHeader("token", $myLocalStorage.get('token'));
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

	          pnotify("¡Acción Realizada.!",json.message,'success'); 
	          success(json);

	        }else{
	           pnotify("¡Ocurrio un Error!",json.message,'error'); 
	           error(json);
	        }

	    },function(header){
	            header.setRequestHeader("usuario",$myLocalStorage.get('id_usuario'));
	            header.setRequestHeader("token", $myLocalStorage.get('token'));
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
	            header.setRequestHeader("usuario",$myLocalStorage.get('id_usuario'));
	            header.setRequestHeader("token", $myLocalStorage.get('token'));
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
	            header.setRequestHeader("usuario",$myLocalStorage.get('id_usuario'));
	            header.setRequestHeader("token", $myLocalStorage.get('token'));
	            header.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
	            
	    },false,false,false,"POST",false,false);

    } );





 }