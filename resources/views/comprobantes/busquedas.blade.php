@extends('template.dashboard-container')
@section('content')
<!-- <link rel="stylesheet" type="text/css" href="{{ asset('dist/remodal.css') }}"">
<link rel="stylesheet" type="text/css" href="{{ asset('dist/remodal-default-theme.css') }}""> -->
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
	<!-- seccion del formulario y/o grid -->
	<div class="container-fluid">
		
		<div class="row">

			<form role="form" class="">
				<div class="col-sm-3">

				  <div class="form-group">
				    <label for="">RFC EMISOR</label>
				    <input type="text" class="form-control" id="rfcEmisor" placeholder="Ingrese emisor">
				  </div>
					
				</div>
				<div class="col-sm-3">
				  
				  <div class="form-group">
				    <label for="">RFC RECEPTOR</label>
				    <input type="text" class="form-control" id="receptor" placeholder="Ingrese Receptor" value="{{ Session::get('rfc') }}" disabled="">
				  </div>
					
				</div>

				<div class="col-sm-3">
				  
				  <div class="form-group">
				    <label for="">FECHA INICIO</label>
				    <input type="text" class="form-control" id="fechaDesde">
				  </div>
					
				</div>

				<div class="col-sm-3">
				  
				  <div class="form-group">
				    <label for="">FECHA FINAL</label>
				    <input type="text" class="form-control" id="fechaHasta" >
				  </div>
					
				</div>


			</form>

		</div>

		<div class="row">

			<form role="form" class="">
				<div class="col-sm-6">

				  <div class="form-group">
				    <label for="">UUID</label>
				    <input type="text" id="uuid" class="form-control" placeholder="000x0000-x00x-00x0-x000-000000000000">
				  </div>
					
				</div>
				<div class="col-sm-6">
				  
				  <div class="col-sm-5">
				  		
					  <div class="form-group">
					    	<label for="">IMPORTE</label>
						  	<div class="input-group">
							    <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
							    <input id="importe" type="text" class="form-control" placeholder="" onkeyup="numerico(this)">
							</div>
					  </div>

				  </div>


					
				</div>
			</form>

		</div>

		<div class="row">
		
			<div class="pull-right">
				<button type="button" class="btn btn-warning btn-lg" onclick="search_comprobante()"> Buscar</button>
			</div>

		</div>


	</div>

	<!-- seccion donde se muestra la tabla de las facturas que se realizo la consulta -->
	<div id="seccion_tabla_cfdi" style="display: none; overflow-y: auto;  height: 150px;" class="table-responsive">
			
			<table class="table table-responsive" id="tabla_cfdi">
				<thead>
					<tr>
						<th>RFC EMISOR</th>
						<th>RAZON SOCIAL</th>
						<th>UUID</th>
						<th>IMPORTE</th>						
						<th></th>						
					</tr>
				</thead>
				<tbody></tbody>
			</table>

	</div>
	<div id="conceptos_detalles" style="display: none; overflow-y: auto;  height: 150px;" class="table-responsive">
		<table class="table table-responsive" id="tabla_conceptos">
			<thead>
				<tr>
					<th>PRODUCTO</th>
					<th>ID</th>
					<th>CLAVE UNIDAD</th>
					<th>DESCUENTO</th>
					<th>CANTIDAD</th>
					<th>UNIDAD</th>		
					<th>DESCRIPCION</th>			
					<th>VALOR UNITARIO</th>
					<th>IMPORTE</th>
					<th></th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>

	</div>

<!--  <a href="#modal">Modal №1</a>

 <div class="remodal" data-remodal-id="modal" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
   <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
   <div class="table-responsive">

	     <table class="table table-responsive" id="tabla_conceptos">
			<thead>
				<tr>
					<th>PRODUCTO</th>
					<th>ID</th>
					<th>CLAVE UNIDAD</th>
					<th>DESCUENTO</th>
					<th>CANTIDAD</th>
					<th>UNIDAD</th>		
					<th>DESCRIPCION</th>			
					<th>VALOR UNITARIO</th>
					<th>IMPORTE</th>
					<th></th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>

   </div>
   <br>
   <button data-remodal-action="cancel" class="remodal-cancel">Cancel</button>
   <button data-remodal-action="confirm" class="remodal-confirm">OK</button>
 </div> -->


	
<script type="text/javascript" src="{{ asset('js/comprobantes/comprobantes.js') }}"></script>
<!-- <script type="text/javascript" src="{{ asset('dist/remodal.min.js') }}"></script> -->

@endsection