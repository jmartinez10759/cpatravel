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
      var url = domain('generate/business');
      var main = domain('home');
      detalles_register(url,fields,function(json){
          window.location= main ;
      },function(json){
        alert("Error en la peticion"); 
      });
      

    }

