@extends('template.dashboard-container')
@section('content')
<div class="container">
			
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
		<!-- seccion de la parte de los datos del usuario logueado -->
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
	<br><br>
	<!-- seccion del formulario y/o grid -->
	<div class="container-fluid">
		
		<div class="row">

			<form role="form" class="">
				<div class="col-sm-3">

				  <div class="form-group">
				    <label for="">CONCEPTOS</label>
				    <input type="text" class="form-control" id="conceptos" placeholder="Ingrese conceptos">
				  </div>
					
				</div>
				<div class="col-sm-3">
				  
				  <div class="form-group">
				    <label for="">ETIQUETAS</label>
				    {!! $select_etiqueta !!}
				  </div>
					
				</div>

				<div class="col-sm-3">
				  
				  <div class="form-group">
				    	<label for="">IMPORTE</label>
					  	<div class="input-group">
						    <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
						    <input id="importe" type="text" class="form-control" placeholder="" onkeyup="numerico(this)">
						</div>
				  </div>
					
				</div>

				<div class="col-sm-3">

				  <div class="form-group">
				    <label for="">FECHA FINAL</label>
				    <input type="text" class="form-control" id="fecha" readonly="">
				  </div>
					
				</div>

			</form>

		</div>

		<div class="row">

			<form role="form" class="">
				<div class="col-sm-4">

				  <div class="form-group">
				    <label for="">COMENTARIOS</label>
				    <textarea class="form-control" id="comentarios"></textarea>
				  </div>
					
				</div>

				<div class="col-sm-4">

				  <div class="form-group">
				    <label for="">SUBIR IMAGEN</label>
				    <textarea class="form-control" id="imagen"></textarea>
				    <input type="hidden" id="path_url_img">
				  </div>
					
				</div>

			</form>

		</div>

		<div class="row">
		
			<div class="pull-right">
				<button type="button" class="btn btn-warning btn-lg" onclick="nocfdi_comprobante()"> Buscar</button>
			</div>

		</div>


	</div>

	<script type="text/javascript" src="{{ asset('js/comprobantes/comprobantes.js') }}"></script>

@endsection