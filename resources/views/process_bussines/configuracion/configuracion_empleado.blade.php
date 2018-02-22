@extends('template.dashboard-container')
@section('content')

		<div class="row">
			
			<div class="col-sm-12">
				<div class="row titulo-pantalla">
                    <div class="col-xs-12 col-sm-12 col-md-12 ">
                    	<span class="icon-tit_solicitud icon-tam2"></span> 
                    	{{$titulo_principal}}
                    </div>
                </div>
			</div>

		</div>
		<!-- seccion de la parte de los datos del usuaria logueado -->
		<div class="row">

				<div class="col-sm-5">
				    <div class="col-sm-12">
				        <div class="col-sm-3">
				            <div class="conten-img">
				                <img alt="User Pic" src="{{ $avatar }}" class="img-circle img-responsive img-profile">
				            </div>
				        </div>
				        <div class="col-sm-9">
				            <div class="conten-img-title">
				                USUARIO: {{ $usuario }}
				            </div>
				        </div>
				    </div>
				</div>
				
				<div class="col-sm-7"> <!-- seccion para agregar otra columna -->  </div>

		</div>

	</div>
	<br>
	<br>
	<div class="container-fluid">
		
		<div class="col-sm-12">
			
			<div class="col-sm-4">
					
			<center><label for="">USUARIOS</label></center>
				<div class="panel panel-default">
				  	<div class="panel-body">			
						<div class="form-group">
						@foreach( $empleados as $empleados )
							<div id="empleados"  ondrop="drop(event)" ondragover="allowDrop(event)" > 
								<li id="{{ $empleados->usuario }}" draggable="true" ondragstart="drag(event)" nombre="{{ $empleados->nombre }}" correo="{{ $empleados->email }}">
									{{ $empleados->nombre }}
								</li>
							</div>
						@endforeach
						</div>

				  	</div>
				</div>



			</div>
			<div class="col-sm-4">
			 <center><label for="">AUTORIZADORES</label></center>
				
				<div class="panel panel-default">
				  	<div class="panel-body" id="autorizadores" ondrop="drop(event)" ondragover="allowDrop(event)"> </div>
				</div>

			</div>
			<div class="col-sm-4">
				
			    <label for="">AUTORIZADOR</label>
			    <div id="autorizador"></div>
				<div class="panel panel-default">
				  	<div class="panel-body" id="autorizador_empleado" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
				</div>
				<div class="row">
					<div class="pull-right">
						<button type="button" class="btn btn-primary btn-lg guardar" onclick="configuracion_auth()">GUARDAR</button>
					</div>
				</div>

			</div>


		</div>
		
	</div>

<script type="text/javascript" src="{{ asset('js/process_bussines/configuracion/configuracion_auth.js') }}"></script>

<script>
	function allowDrop(ev) { ev.preventDefault(); }

	function drag(ev) { ev.dataTransfer.setData("text", ev.target.id); }

	function drop(ev) {
	    ev.preventDefault();
	    var data = ev.dataTransfer.getData("text");
	    ev.target.appendChild(document.getElementById(data));
	    //se manda a llamar la funcion para poblar el combo dinamicamente
	    combo_autorizador();
	}
</script>


@endsection