$().ready(function(){
    initDataTable('datatable');		
});
/**
 *Funcion para seleccionar y obtener los datos de la empresa
 *@params object [description]
 *@return void
 */
    function business( json ){
      
      var fields = {
          'id'            :  json.id_empresa
          ,'group_id'     :  json.id_grupo
          ,'description'  :  json.description
      }
      var path_url = $('#path_url').val();
      var main = $('#path_index').val();
      requestAjaxSend( path_url, fields ,function(msg){
    			
          if (msg.success === true) {
    			  	window.location= main ;
    			}else{ 
    				alert("Error en la peticion"); 
    			}

      },false, false, false, false,'GET',false);
      

    }

