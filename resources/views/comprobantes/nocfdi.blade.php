@extends('template.dashboard-container')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css" />

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
				<div class="col-sm-4">
				  <div class="form-group">
				    <label for="">PROYECTOS</label>
				    {!! $proyectos !!}
				  </div>
				</div>

				<div class="col-sm-4">
				  <div class="form-group">
				    <label for="">SUBPROYECTOS</label>
				    {!! $subproyectos !!}
				  </div>
				</div>

				<div class="col-sm-4">
				  <div class="form-group">
				    <label for="">VIAJES</label>
				    {!! $viajes !!}
				  </div>
				</div>

			</form>

		</div>
		<div class="row">
			
			<form role="form" >

				<div class="col-sm-3">
				  <div class="form-group">
				    <label for="">CONCEPTOS</label>
				    <textarea class="form-control" id="conceptos"></textarea>
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
			<form role="form">
				
				<div class="col-sm-6">
				  <div class="form-group">
				    <label for="">COMENTARIOS</label>
				    <textarea class="form-control" id="comentarios"></textarea>
				  </div>
				</div>

			</form>
		</div>

		<div class="row">
		
			<div class="pull-right">
				<button type="button" class="btn btn-info btn-lg" data-fancybox data-options='{"src": "#load_imgen", "touch": false, "smallBtn" : false}'> Cargar Imagen</button>
				<button type="button" class="btn btn-warning btn-lg" onclick="nocfdi_comprobante()"> Buscar</button>
			</div>

		</div>


	</div>


	<div style="display: none; max-width:1500px;" id="load_imgen">
	    
	    <div class="container">
	    	<div class="row">
	    		<div>
	    			<button type="button" class="btn" id="capturar">Capturar</button>
	    			<button type="button" class="pull-right btn" id="upload">Subir Imagen</button>
	    		</div>
	    	</div>
	    	
	    	<div class="row col-sm-12" id="div_capturar">
	    		<div class="col-sm-5">
	    			<div id="my_camera"></div>
	    		</div>
	    		<div class="col-sm-2">
	    			<button type="button" class="btn btn-default" onclick="take_snapshot()">Tomar Foto</button>
	    		</div>
	    		<div class="col-sm-5">
	    			<div id="results"></div>
	    		</div>

	    	</div>

	    	<div class="row" style="display: none;" id="div_upload">
	    		<input type="text" id="etiqueta_img">
                <div id="div_dropzone_file"></div>
	    	</div>

	    </div>	
	    
	</div>

	<script type="text/javascript" src="{{ asset('js/comprobantes/comprobantes.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>
	<script type="text/javascript" src="{{ asset('js/webcam.min.js') }}"></script>

	<script type="text/javascript">
		
		$('#capturar').click(function(){

			$('#div_capturar').show('slow');
			$('#div_upload').hide();
		});
		$('#upload').click(function(){
			$('#div_capturar').hide();
			$('#div_upload').show('slow');
		});


		Webcam.set({
			width: 250,
			height: 250,
			image_format: 'jpeg',
			jpeg_quality: 90
		});
		Webcam.attach( '#my_camera' );


		take_snapshot = function () {

			Webcam.snap( function( data_uri ) {

				document.getElementById('results').innerHTML = 
					'<img src="'+data_uri+'" width="250px" height="250px"/>';
					
			} );
		}
	</script>
	<!-- <script type="text/javascript" src="{{ asset('js/llqrcode.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/webqr.js') }}"></script> -->
	<!-- <script type="text/javascript">load();</script> -->
@endsection