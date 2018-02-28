@extends('template.dashboard-container')
@section('content')
<style type="text/css">
	.title-left {
	  background-color: #003399;
	  padding: 8px;
	  border-radius: 20px;
	  margin-bottom: 20px;
	}
	.title-left label {
	  color: #ffffff;
	  font-size: 21px;
	  margin:0;
	  text-align: center;

	}
</style>

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
<br><br>
<div class="container-fluid">

	<div class="col-sm-12">

		<div class="col-sm-6">
			<div class="panel panel-default title-left">
			  	<div class="panel-body">
					<center><label for="">LISTA DE EMPLEADOS</label></center>
			  	</div>
			</div>
			<div class="panel panel-default" style="overflow-y: auto; height: 440px">
			  	<div class="panel-body">			
					<div class="form-group">
					@foreach( $empleados as $empleados )
						<div id="empleados" ondrop="drop(event)" ondragover="allowDrop(event)"> 

							<li id="{{ $empleados->usuario }}" draggable="true" ondragstart="start(event)" nombre="{{ $empleados->nombre }}" correo="{{ $empleados->email }}">

								<button type="button" class="" onclick="eliminar(this)" data-toggle="tooltip" title="Borrar"><i class="fa fa-trash"> </i></button>

								<select class="" >
									<option value=""></option>
									<option value="y">Y</option>
									<option value="o">O</option>
								</select>
								{{ $empleados->nombre }}
							</li>
						</div>
					@endforeach
					</div>

			  	</div>
			</div>

		</div>

		<div class="col-sm-6" id="group_autorizadores">
			
			<div class="panel panel-default title-left">
			  	<div class="panel-body">
			  		<center>
				  		<label>DESDE:</label> 
				  		<input type="text" id="desde"><br>
				  		<select id="operador">
				  			<option value="/"> / </option>
				  			<option value=">"> > </option>
				  			<option value="<"> < </option>
				  		</select>
				  		<br>
				  		<label>HASTA:</label> 
				  		<input type="text" id="hasta">
			  		</center>
			  	</div>
			</div>
			<div class="panel panel-default" id="autorizador_empleado">
			  	<div class="panel-body" ondrop="clonar(event)" ondragover="allowDrop(event)"></div>
			</div>
			<div class="row">
				<div class="pull-right">
					<button type="button" class="btn btn-success btn-lg guardar" onclick="group_autorizadores()">	CONTINUAR
					</button>
				</div>
			</div>

		</div>

		<div class="col-sm-6" id="autorizadores_auth" style="display: none;" >
		    
			<div class="panel panel-default title-left">
			  	<div class="panel-body">
					<center>
						<div id="grupo_select"></div>
					</center>
			  	</div>
			</div>

			<div class="panel panel-default" id="group_empleados">
			  	<div class="panel-body" ondrop="clonar(event)" ondragover="allowDrop(event)"></div>
			</div>

			<div class="row">
				<div class="pull-right">
					<button type="button" class="btn btn-primary btn-lg" onclick="back_configuracion()">ATRAS</button>
					<button type="button" class="btn btn-success btn-lg guardar" onclick="configuracion_auth()">GUARDAR</button>
				</div>
			</div>
		</div>



	</div>

</div>


<script type="text/javascript" src="{{ asset('js/process_bussines/configuracion/configuracion_auth.js') }}"></script>

@endsection