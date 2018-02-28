@extends('template.dashboard-container')
@section('content')
<style type="text/css">
body{
    width:100%;
    text-align:center;
}
img{
    border:0;
}
#main{
    margin: 15px auto;
    background:white;
    overflow: auto;
	width: 100%;
}
#header{
    background:white;
    margin-bottom:15px;
}
#mainbody{
    background: white;
    width:100%;
	display:none;
}
#footer{
    background:white;
}
#v{
    width:320px;
    height:240px;
}
#qr-canvas{
    display:none;
}
#qrfile{
    width:320px;
    height:240px;
}
#mp1{
    text-align:center;
    font-size:35px;
}
#imghelp{
    position:relative;
    left:0px;
    top:-160px;
    z-index:100;
    font:18px arial,sans-serif;
    background:#f0f0f0;
	margin-left:35px;
	margin-right:35px;
	padding-top:10px;
	padding-bottom:10px;
	border-radius:20px;
}
.selector{
    margin:0;
    padding:0;
    cursor:pointer;
    margin-bottom:-5px;
}
#outdiv
{
    width:320px;
    height:240px;
	border: solid;
	border-width: 3px 3px 3px 3px;
}
#result{
    border: solid;
	border-width: 1px 1px 1px 1px;
	padding:20px;
	width:70%;
}

ul{
    margin-bottom:0;
    margin-right:40px;
}
li{
    display:inline;
    padding-right: 0.5em;
    padding-left: 0.5em;
    font-weight: bold;
    border-right: 1px solid #333333;
}
li a{
    text-decoration: none;
    color: black;
}

#footer a{
	color: black;
}
.tsel{
    padding:0;
}

</style>
<!-- <link rel="stylesheet" type="text/css" href="{{ asset('css/demo.css') }}"">
<link rel="stylesheet" type="text/css" href="{{ asset('css/dialog-confirm.css') }}""> -->
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
				<!-- <div class="col-sm-3">
				  
				  <div class="form-group">
				    <label for="">RFC RECEPTOR</label>
				    <input type="text" class="form-control" id="receptor" placeholder="Ingrese Receptor" value="{{ Session::get('rfc') }}" disabled="">
				  </div>
					
				</div> -->
				<div class="col-sm-3">

				  <div class="form-group">
				    <label for="">PROYECTOS</label>
				    {!! $proyectos !!}
				  </div>
					
				</div>
				<div class="col-sm-3">

				  <div class="form-group">
				    <label for="">SUBPROYECTOS</label>
				    {!! $subproyectos !!}
				  </div>
					
				</div>
				<div class="col-sm-3">

				  <div class="form-group">
				    <label for="">VIAJES</label>
				    {!! $viajes !!}
				  </div>
					
				</div>
				<div class="col-sm-3">

				  <div class="form-group">
				    <label for="">RFC EMISOR</label>
				    <input type="text" class="form-control" id="rfcEmisor" placeholder="Ingrese emisor">
				  </div>
					
				</div>

			</form>

		</div>

		<div class="row">

			<form role="form" class="">
				<div class="col-sm-4">

				  <div class="form-group">
				    <label for="">UUID</label>
				    <input type="text" id="uuid" class="form-control" placeholder="000x0000-x00x-00x0-x000-000000000000">
				  </div>
					
				</div>
				<div class="col-sm-3">
				  
				  <div class="form-group">
				    <label for="">FECHA INICIO</label>
				    <input type="text" class="form-control" id="fechaDesde" readonly="">
				  </div>
					
				</div>

				<div class="col-sm-3">
				  
				  <div class="form-group">
				    <label for="">FECHA FINAL</label>
				    <input type="text" class="form-control" id="fechaHasta" readonly="">
				  </div>
					
				</div>
				<div class="col-sm-2">
				  
				  <div class="form-group">
				    <label for="">IMPORTE</label>
				  	<div class="input-group">
					    <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
					    <input id="importe" type="text" class="form-control" placeholder="" onkeyup="numerico(this)">
					</div>
				  </div>
					
				</div>

			</form>

		</div>

		<div class="row">
		
			<div class="pull-right">
				<!-- <button type="button" class="btn btn-info btn-lg" onclick="upload_img(this)"> Imagen QR</button> -->
				<a class="btn btn-info btn-lg" data-fancybox data-options='{"src": "#qr", "touch": false, "smallBtn" : false}' href="javascript:;" id="imagenqr"> Imagen QR</a>
				<button type="button" class="btn btn-warning btn-lg" onclick="search_comprobante(this)">Buscar</button>
			</div>

		</div>


	</div>
	<br><br>
	<!-- seccion donde se muestra la tabla de las facturas que se realizo la consulta -->
	<div id="seccion_tabla_cfdi" style="display: none; overflow-y: auto;  height: 250px;" class="table-responsive">
			
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
	<br><br>


	<!-- <div style="display: none;" id="hidden-content">
		
		<div id="mainbody" class="container">
			<img class="selector" id="webcamimg" src="vid.png" onclick="setwebcam()" align="left" />
			<img class="selector" id="qrimg" src="cam.png" onclick="setimg()" align="right"/>
	    	<div id="outdiv"></div>
	    	<canvas id="qr-canvas" width="800" height="600"></canvas>
	    	<div id="result" width="800" height="100"></div>
	    </div>

	</div>
	<a class="btn btn-info" data-fancybox data-src="#hidden-content" href="javascript:;">
		Trigger the fancyBox
	</a> -->


	 <!-- <a data-fancybox data-options='{"src": "#exampleModal", "touch": false, "smallBtn" : false}' href="javascript:;" class="btn">Open demo</a> -->


	  <div style="display: none;max-width:1500px;" id="qr">
	    	
	    	<!-- <div id="mainbody" class="container">
	    		<button type="button" id="webcamimg" class="btn btn-primary" onclick="setwebcam()" align="left">
	    			<span class="glyphicon glyphicon-facetime-video" aria-hidden="true"></span>
	    		</button>
	    		<button type="button" class="btn btn-info pull-right" id="qrimg" onclick="setimg()" align="right">
	    			<span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
	    		</button>
		    	<div id="outdiv"></div>
		    	<canvas id="qr-canvas" width="1000px" height="800px"></canvas>
		    	<div id="result" width="1000px" height="800px"></div>
		    </div> -->
    	<video id="preview"></video>


	  </div>
	  <div id="qr" style="display: none; max-width: 1500px">
		  	 <div id="reader" style="width:300px; height:250px"></div>
	  </div>

	<div id="conceptos_detalles" style="display: none; overflow-y: auto;  height: 350px;" class="table-responsive container">
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
<!-- <div style="width: 350px; height: 350px;" id="qrcodebox">
</div>
<input type="button" value="Start" id="btn_start" /> 
<input type="button" value="Stop" id="btn_stop" />
<p>
Last QRCode value: <span id="qrcode_result">none</span>
</p> -->

<!-- <select id="videoSource"></select>
<select id="audioSource"></select>
<video muted autoplay></video> -->







<!-- <script type="text/javascript" src="{{ asset('js/qrcode/lib/html5-qrcode.min.js') }}"></script> -->
<script type="text/javascript" src="{{ asset('js/instascan.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/comprobantes/comprobantes.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>
<!-- <script type="text/javascript" src="{{ asset('js/read_qr.js') }}"></script> -->
<!-- <script type="text/javascript">
		
		$('#qrcodebox').WebcamQRCode({
			onQRCodeDecode: function( p_data ){
					alert(p_data);
					$('#qrcode_result').html( p_data );
			}
		});
		
		$('#btn_start').click(function(){
			$('#qrcodebox').WebcamQRCode().start();
		});
		
		$('#btn_stop').click(function(){
			$('#qrcodebox').WebcamQRCode().stop();
		});

</script> -->

<script type="text/javascript" src="{{ asset('js/llqrcode.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/webqr.js') }}"></script>
<script type="text/javascript">load();</script>
<!-- <script type="text/javascript" src="{{ asset('dist/remodal.min.js') }}"></script> -->
<script type="text/javascript">
      let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
      scanner.addListener('scan', function (content) {
        console.log( content );
        alert( content );
      });
      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          	scanner.start(cameras[0]);
        } else {
        	alert('No cameras found.');
            console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
        alert( e );

      });
</script>

@endsection