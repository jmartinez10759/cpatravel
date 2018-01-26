@extends('template.dashboard-container')
@section('content')
<div class="container">
	
	<div class="row titulo-pantalla">
        <div class="col-xs-12 col-sm-12 col-md-12 ">
        	<span class="icon-estado_cta icon-tam2"></span> {{$titulo_principal}}
        </div>
    </div>
    <br>
	<div class="row">
		
		<div class="col-xs-12">
			<div class="col-sm-6">
				<!-- seccion de usuario loggeado -->
				<div class="col-sm-3">
                    <div class="conten-img">
                        <img alt="User Pic" src="{{$avatar}}" class="img-circle img-responsive img-profile">
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="conten-img-title">
                        USUARIO: {{$usuario}}
                    </div>
                </div>

			</div>			

			<div class="col-sm-6">
				<!-- seccion de calendario -->
				<div class="col-sm-12">
					
					<div class="col-sm-2 notificaciones">	
						<span class="icon-notificaciones" style="vertical-align: middle; margin-top:20px;"></span>
					</div>
					<div class="col-sm-5 right">
						<span class="icon-calendario"></span> De:
						<input type="text" class="form-control" id="datepicker_inicio">
					</div>
					<div class="col-sm-5 right">
						<span class="icon-calendario"></span> A:
						<input type="text" class="form-control" id="datepicker_fin">
					</div>	

				</div>

			</div>			
		</div>

	</div>
	<br>
	<div class="row">
			
		<div class="col-sm-2">
			<span class="icon-proyectos_verde"></span> Proyectos
			{!! $select_proyecto !!}
		</div>
		
		<div class="col-sm-2">
			<span class="icon-subproyectos_verde"></span> Subproyectos
			{!! $select_subproyecto !!}
		</div>
		
		<div class="col-sm-2">
			<span class="icon-viaje_verde"></span> Viajes
			{!! $select_viaje !!}
		</div>
		
		<div class="col-sm-2">
			<label class="control-label">Estatus</label>
			{!! $select_estatus !!}
		</div>
		
		<div class="col-sm-2">
			<label class="control-label">Etiquetas </label>
			{!! $select_etiquetas !!}
		</div>

		<div class="col-sm-2">
			
			  <div class="col-sm-4" style="cursor: pointer;" data-toggle="tooltip" title="Pendientes">
				<span class="icon-pendientes element-viatico"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></span>
			  </div>

		      <div class="col-sm-4" style="cursor: pointer;" data-toggle="tooltip" title="Geolocalización">
				<span class="icon-geolocalizacion_menu_hover element-viatico"></span>
			  </div>

			  <div class="col-sm-4" style="cursor: pointer;" data-toggle="tooltip" title="Solicitud">
				  <span class="icon-solicitud element-viatico"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></span>
			  </div>

		</div>

	</div>
	<br>
	<!-- seccion del grid -->
	<div class="row">

		<div class="table-responsive">
			
			<table class="table table-hover table-striped table-response">
				<thead>
					<tr>
						<th></th>
						<th></th>
						<th></th>
						<th class="center">USUARIO</th>						
						<th></th>
						<th class="center">ADMINISTRADOR</th>
					</tr>
					<tr>
						<th>Proyectos Subproyectos viajes</th>
						<th>Concepto</th>
						<th>Etiqueta Predeterminada</th>
						<th>Fecha</th>
						<th>Monto Pagado</th>
						<th>Comprobacion</th>
						<th>Saldo</th>
						<th>Estatus</th>
						<th>Metodo de Pago</th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</tbody>
			</table>

		</div>

	</div>
	<!-- seccion de mensajes de total -->
	<div class="row">
		
		<div class="col-sm-12">
			
			<div class="col-sm-offset-4 col-sm-2 totales">
				<span class="icon-transferir_saldo elemento"></span><br>
				<center>TRANSFERIR SALDO</center>
			</div>
			<div class="col-sm-6 totales">
				<div id="total">$0</div><br>TOTAL
			</div>

		</div>


	</div>





<script type="text/javascript" src="{{ asset('js/estados_cuenta/estados_cuenta.js') }}"></script>

</div>
@endsection