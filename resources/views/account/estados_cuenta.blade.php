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
						<input type="text" class="form-control" id="datepicker_inicio" readonly="">
					</div>
					<div class="col-sm-5 right">
						<span class="icon-calendario"></span> A:
						<input type="text" class="form-control" id="datepicker_fin" readonly="" onblur="between_fecha()">
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
			<label class="control-label">Conceptos</label>
			{!! $select_estatus !!}
		</div>
		
		<div class="col-sm-2">
			<label class="control-label">Etiquetas </label>
			{!! $select_etiquetas !!}
		</div>

		<div class="col-sm-2">
			
			  <div class="col-sm-4" style="cursor: pointer;" data-toggle="tooltip" title="Pendientes" onclick="carga_vista_html('comprobantes/menus','estadoscuenta','estadoscuenta')">
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

		<div class="col-sm-12">

				<div class="table-responsive col-sm-7">

					<table class="table table-hover table-striped table-responsive" id="datatable_usuario">
						<thead>
							<tr>
								<th></th>
								<th></th>
								<th></th>
								<th class="center">USUARIO</th>
								<th></th>
								<th></th>
							</tr>
							<tr>
								<th></th>
								<th>
									<div class="row">PROYECTO</div>
									<div class="row">SUBPROYECTO</div>
									<div class="row">VIAJE</div>
								</th>
								<th>
									<div class="row"> CONCEPTO</div>
									<div class="row"><br></div>
									<div class="row"> MOVIMIENTOS</div>
								</th>
								<th>
									<div class="row"><br></div>
									<div class="row">ETIQUETA</div>
									<div class="row"><br></div>
								</th>
								<th>
									<div class="row"><br></div>
									<div class="row">FECHA</div>
									<div class="row"><br></div>
								</th>
								<th>
									<div class="row"><br></div>
									<div class="row"> MONTO PAGADO</div>
									<div class="row"><br></div>
								</th>
							</tr>
						</thead>
						<tbody>
							@foreach($tabla_estado_cuenta as $estadoscuenta)
							<tr>
								<td></td>
								<td>
									<div class="row">{{ $estadoscuenta->proyecto }}</div>
									<div class="row">{{ $estadoscuenta->subproyecto }}</div>
									<div class="row">{{ $estadoscuenta->viaje }}</div>
								</td>
								<td></td>
								<td>
									<div class="row"><br></div>
									<div class="row"><center>{{ $estadoscuenta->etiqueta_nombre }}</center></div>
									<div class="row"><br></div>
								</td>
								<td>
									<div class="row"><br></div>
									<div class="row"><center>{{ $estadoscuenta->solicitud_fecha_inicio }}</center></div>
									<div class="row"><br></div>
								</td>
								<td>
									<div class="row"><br></div>
									<div class="row"><center>{{ $estadoscuenta->viatico_costo_unitario }}</center></div>
									<div class="row"><br></div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>

				</div>
				<div class="table-responsive col-sm-5">
					<table class="table table-hover table-striped table-responsive" id="datatable_admin">
						<thead>
							<tr>
								<th></th>
								<th></th>
								<th class="center">ADMINISTRADOR</th>
								<th></th>
								<th></th>
							</tr>
							<tr>
								<th></th>
								<th>
									<div class="row"><br></div>
									<div class="row"> <center> COMPROBACION </center> </div>
									<div class="row"><br></div>
								</th>
								<th>
									<div class="row"><br></div>
									<div class="row"> <center>SALDO</center> </div>
									<div class="row"><br></div>
								</th>
								<th>
									<div class="row"><br></div>
									<div class="row"><center>ESTATUS</center> </div>
									<div class="row"><br></div>
								</th>
								<th>
									<div class="row"><br></div>
									<div class="row"> <center>METODO DE PAGO</center> </div>
									<div class="row"><br></div>
								</th>
							</tr>
						</thead>
						<tbody>
							@foreach($tabla_estado_cuenta as $estadoscuenta)
							<tr>
								<td></td>
								<td>
										<div class="row"><br></div>
										<div class="row"><center> {{ $estadoscuenta->monto_tipo_pago }} </center></div>
										<div class="row"><br></div>
									</td>
									<td>
										<div class="row"><br></div>
										<div class="row"><center> {{ $estadoscuenta->monto_tipo_pago }} </center></div>
										<div class="row"><br></div>
									</td>
									<td>
										<div class="row"><br></div>
										<div class="row"><center> {{ $estadoscuenta->monto_tipo_pago }} </center></div>
										<div class="row"><br></div>
									</td>
									<td>
										<div class="row"><br></div>
										<div class="row"><center> {{ $estadoscuenta->monto_tipo_pago }} </center></div>
										<div class="row"><br></div>
									</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>

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