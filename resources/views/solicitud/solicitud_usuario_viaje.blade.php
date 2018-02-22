<!-- controller es SolicitudViajeController@solicitudes_pendientes-->
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div class="row titulo-pantalla">
                <div class="col-xs-12 col-sm-12 col-md-12 "><span class="icon-tit_solicitud icon-tam2"></span> SOLICITUDES GENERADAS</div>
            </div>
            <br><br>
            <div class="row">
            	<div class="collapse in">

            		<div class="col-sm-12"> 
            			<div class="col-sm-4">
            				
            			</div>

            			<div class="col-sm-4">
            				<div class="row">
								<select class="form-control" id="filtro_estatus" onchange="filtro_estatus()" >
									<option value="Todos">Todos</option>
									<option value="Pendiente">Pendiente</option>
									<option value="Enviado">Enviado</option>
									<option value="Rechazado">Rechazado</option>
									<option value="Autorizado">Autorizado</option>
									<option value="Cancelado">Canceslado</option>
								</select>
							</div>
            			</div>

            			<div class="col-sm-4">
            				<div class="btn-toolbar pull-right">
								<button class="btn btn-success" onclick="carga_vista_html('solicitud','solicitud/pendientes')"><i class="fa fa-plus-circle"> </i> Nueva Solicitud </button>
							</div>
            			</div>

            		</div>

				</div>
            </div>
            <br><br>
			<div class="row">
				<div class="table-response">
					{!!$tabla_solicitudes!!}	
				</div>
			</div>
			<br>
		</div>
	</div>
</div>

<input type="hidden" id="return" value="{{ $return }}">

<script type="text/javascript">
	initDataTable('datatable');
	  $('#button_back_general').attr('disabled',false);
      $('#button_back_general').removeAttr('onclick');
      $('#button_back_general').attr('onclick','carga_vista_html("authorization","business/process")');
</script>
