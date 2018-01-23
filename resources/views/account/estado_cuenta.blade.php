
	@extends('layouts.app')
	@section('content')
	
	<style>
		.titulo-pantalla{
   			 text-align: center;
    		color: #009577;
			font-size: 30px;
			margin-top: 10px;
			margin-bottom: 20px;
			
		}
		
		.icon-tam2 {
         font-size: 55px;
		 padding-left: 10px;
		 text-align: center;
		 vertical-align: text-bottom;
		
     	}
		
		.conten-img-title {
    	text-align: left;
   		color: #009577;
   		
    	font-size: 16px;
		}	
		
		.form-fecha {
    	border-radius: 5px;
    	border: #33337f solid 1px;
    	width: 40%;
    	margin-top: 5px;
		}
		
		.busqueda{
		margin-top: 20px;	
		}
		
		.buscador{
		margin-top: 20px;	
		}
		
		.botones{
		font-size: 10px;
		color: #303082;
		text-align: center;
		padding-left: 5px;
		}
		
		.metodo_pago{
		font-size: 10px;
		color: #303082;
		text-align: center;
		padding-left: 5px;
		border-bottom: #ddd solid 1px;
		}
		
		
		.tam_menu{
		font-size: 120px;
		text-align: center;
		}
		
		
		.right{
		text-align: right;
		color:#303082;
		}
		
		.left{
		text-align: left;
		color:#303082;
		font-size: 14px;
		vertical-align: middle;
		}
		
		.form-search {
   		border-radius: 5px;
    	border: #33337f solid 1px;
    	width: 160px;
    	margin-top: 5px;
		padding: 5px;
		}
		.form-search2 {
   		border-radius: 5px;
    	border: #33337f solid 1px;
    	width:100%;
		color:#b2b2b2;
		padding: 5px 3px 5px 3px;
		}
		
		.form-search3 {
   		border-radius: 5px;
    	border: #33337f solid 1px;
    	width:90%;
		color:black;
		padding: 5px 3px 5px 3px;
		}
		
		.tam3{
		font-size: 45px;
		text-align: center;
		}
		
		.edo_detalle{
		margin-top: 20px;	
		width: 100%;
		margin-left: 5px;
		padding: 3px;
		
		}
		
		.table_edocta_izq{
		background-color: #494791;
		border-top-left-radius: 10px;
		padding: 5px;
		color:white;
		font-size: 18px;
		text-align: right;
		letter-spacing: 5px;
		}
		
		.table_edocta_der{
		background-color: #494791;
		border-top-right-radius: 10px;
		padding: 5px;
		color:white;
		font-size: 18px;
		text-align: left;
		letter-spacing: 5px;
		border-left: #ffffff solid 1px;
		}
		
		.tit_comprobacion{
		border-left: #ffffff solid 1px;
		background-color: #303082;
		padding: 3px;
		color:white;
		font-size: 14px;
		text-align: left;
		}
		
		.tit_proy{
		background-color: #303082;
		border-bottom-left-radius: 10px;
		padding: 3px;
		color:white;
		font-size: 14px;
		text-align: left;
		}
		
		.tit_status{
		background-color: #303082;
		padding: 3px;
		color:white;
		font-size: 14px;
		text-align: left;
		}
		
		.tit_metodo{
		background-color: #303082;
		padding: 2px;
		color:white;
		font-size: 14px;
		text-align: center;
		}
		
		.tit_acciones{
		background-color: #303082;
		border-bottom-right-radius: 10px;
		padding: 3px;
		color:white;
		font-size: 14px;
		text-align: left;
		}
		
		.notificaciones{
			top:8px;
		}
		
		.status_pendiente{
		font-size: 12px;
		color: black;
		text-align: left;
		padding: 5px;
		border-bottom: #ddd solid 1px;
		}
		
		.status_confirmado{
		font-size: 12px;
		color: #009576;
		text-align: left;
		padding: 5px;
		border-bottom: #ddd solid 1px;
		}
		
		.status_rechazado{
		font-size: 12px;
		color: #c60c0e;
		text-align: left;
		padding: 5px;
		border-bottom: #ddd solid 1px;
		}
		
		.status_comprobacion_pendiente{
		font-size: 12px;
		color: black;
		text-align: left;
		padding: 5px;
		border-bottom: #ddd solid 1px;
		border-left: #ddd solid 1px;
		}
		
		.icon-tam4{
		font-size: 28px;
		
		}
		
		.icon-tam5{
		font-size: 25px;
		
		
		}
		
		.icon-tam6{
		font-size: 97px;
		
		
		}
		
		.acciones_botones{
		font-size: 20px;
		text-align: center;
		border-bottom: #ddd solid 1px;
		}
		
		.confirmacion-pendiente{
		text-align: center;
		border-bottom: #ddd solid 1px;
		}
		
		.totales{
		color:#303082;
		font-size: 18px;
		text-align: center;
		background:#ececeb;
		padding: 10px;
		margin-bottom: 20px;
		}
		
		.center{
		text-align: center;
		}
		
		#status{
		font-size: 10px;
		}
		
		#viaticos{
		font-size: 10px;
		}
		
		 #total{
            display: inline-block;
            padding-top: 25px;
			padding-bottom: 10px;
            text-align: center;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: #008e7e;
			color: white;
			font-size: 30px;
			vertical-align: middle;
			
        }
		
		p {
		color:#303082;
		font-size: 14px;
		text-align: left;
		font-weight:normal;
		}
		
		h1 {
		color:#706f6f;
		font-size: 12px;
		text-align: center;
		font-weight:normal;
		}
		
		
	</style>
	

<div class="container">
	<div class="row titulo-pantalla">
		<div class="col-md-12 col-xs-12">
		<span class="icon-estado_cta icon-tam2"></span>
		ESTADO DE CUENTA	
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 col-xs-12">
			<div class="col-md-2 col-xs-2">
				<div class="conten-img">
                            <img alt="User Pic" src="{{ Session::get('img') }}" class="img-circle img-responsive img-profile">
                        </div>
			</div>
			<div class="col-md-10 col-xs-10">
				<div class="conten-img-title">
					{{ Session::get('name').'  '.Session::get('lastName') }}
				</div>
			</div>
			
		</div>
		<div class="col-md-6 col-xs-12">
			<div class="col-md-5 col-xs-5 right">
				<span class="icon-calendario"></span>
				De:
				<input type="text" class="form-fecha" id="datepicker_inicio" readonly="readonly">
			</div>
			<div class="col-md-5 col-xs-5 right">
			
				<span class="icon-calendario"></span>
				A:
				<input type="text" class="form-fecha" id="datepicker_fin" readonly="readonly">
				</div>	
			<div class="col-md-2 col-xs-2 notificaciones">	
				<span class="icon-notificaciones" style="vertical-align: middle; margin-top:20px;"></span>
			</div>
			</div>
		</div>
	</div>
  <div class="row busqueda">
  	<div class="col-md-5 col-xs-12">
		<div class="col-md-4 col-xs-12 left">
			
			<span class="icon-proyectos_verde"></span>
			Proyecto:<br>
			<a href="#" style="text-decoration: underline; font-size: 12px; color: #009576;">Seleccionar</a><br>
			<input type="text" class="form-search2 search_project" name="proyecto_name" id="proyecto_name" placeholder="Busque por Proyecto" style="font-size: 12px">
			<input type="text" name="project_id" id="project_id">
	  </div>
	  <div class="col-md-4 col-xs-12 left">
		  <span class="icon-subproyectos_verde"></span>
			Subproyecto:<br>
			<a href="#" style="text-decoration: underline; font-size: 12px; color: #009576;">Seleccionar</a><br>
			<input type="text" class="form-search2 search_subproject" name="subproyecto_name" id="subproyecto_name" placeholder="Busque por Subproyecto" style="font-size: 12px">
		  	<input type="text" name="subproject_id" id="subproject_id">
		</div>
		<div class="col-md-4 col-xs-12 left">
			
			<span class="icon-viaje_verde"></span>
			Viaje:<br>
			<a href="#" style="text-decoration: underline; font-size: 12px; color: #009576;">Seleccionar</a><br>
			<input type="text" class="form-search2 search_travel" name="travel_name" id="travel_name" placeholder="Busque por Viaje" style="font-size: 12px">
			<input type="text" name="travel_id" id="travel_id">
			
		</div>

	  </div>
    <div class="col-md-7 col-xs-12">
	  	<div class="col-md-4 col-xs-6 left">
	  	  <p>Status: </p>
	  	  <p>
	  	    <select name="status" id="status" class="form-control">
				<option value="0">Todos los status</option>
				@foreach($status as $st)
					<option value="{{ $st->id }}">{{ $st->name }}</option>
				@endforeach
  	        </select>
  	      </p>
		  </div>
		  <div class="col-md-4 col-xs-6 left" >
	  	    <p>Etiqueta Predeterminada:            </p>
	  	    <p>
	  	      <select name="viaticos" id="viaticos" class="form-control">
	  	        <option value="0">Todos los tipos de viático</option>
				  @foreach($label as $lb)
					  <option value="{{ $lb->id }}">{{ $lb->name }}</option>
				  @endforeach
  	          </select>
  	        </p>
		  </div>
		  <div class="col-md-1 col-xs-4 botones">
		  <span class="icon-pendientes tam3"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></span><br>
	  	Pendientes
		  </div>
		  <div class="col-md-2 col-xs-4 botones">
		  <span class="icon-geolocalizacion_menu_hover tam3"></span><br>
	  	Geolocalización
	  </div>
		  <div class="col-md-1 col-xs-4 botones">
		  <span class="icon-solicitud tam3"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></span><br>
	  	Solicitud
	  </div>
	  </div>
	</div>
	<div class="row edo_detalle">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tbody>
    <tr>
      <td colspan ="5" class="table_edocta_izq">USUARIO</td>
      <td colspan="8" class="table_edocta_der">ADMINISTRADOR</td>
      </tr>
    <tr>
      <td width="172" class="tit_proy">
      Proyecto<br>
      Subproyecto<br>
      Viaje<br>
      
      </td>
      <td width="224" class="tit_status">Status</td>
      <td width="152" class="tit_status">Etiqueta Predeterminada</td>
      <td width="146" class="tit_status">Fecha</td>
      <td width="160" class="tit_status">Monto Pagado</td>
      <td width="146" class="tit_comprobacion">Comprobación</td>
      <td width="147" class="tit_status">Saldo</td>
      <td width="95" class="tit_status">Confirmación</td>
      <td width="106" class="tit_metodo">Método<br>
        de Pago</td>
      <td colspan="4" class="tit_acciones">&nbsp;</td>
      </tr>
    <tr>
      <td class="status_pendiente"><span class="icon-proyectos_verde"></span>&nbsp;Santander<br>
		  <span class="icon-subproyectos_verde"></span>&nbsp;Congreso Anual<br>
        <span class="icon-viaje_verde"></span>&nbsp;Veracruz 2017</td>
      <td class="status_pendiente">Solicitando CFDI</td>
      <td class="status_pendiente">Hospedaje</td>
      <td class="status_pendiente"><input type="text" class="form-search3" style="font-size: 12px"></td>
      <td class="status_pendiente"><input type="text" class="form-search3" style="font-size: 12px" placeholder="$"></td>
      <td class="status_comprobacion_pendiente"><input type="text" class="form-search3" style="font-size: 12px" placeholder="$"></td>
      <td class="status_pendiente"><input type="text" class="form-search3" style="font-size: 12px" placeholder="$"></td>
      <td class="confirmacion-pendiente"><span class="icon-circulo_pendiente icon-tam5"></span></td>
      <td class="metodo_pago"><span class="icon-pago_transferencia icon-tam4"></span><br>
        Transferencia</td>
      <td width="49" class="acciones_botones"><span class="icon-icono_guardar"></span></td>
      <td width="53" class="acciones_botones"><span class="icon-icono_enviar"></span></td>
      <td width="45" class="acciones_botones"><span class="icon-nota"></span></td>
      <td width="45" class="acciones_botones"><span class="icon-icono_mapa"></span></td>
    </tr>
    <tr>
      <td class="status_pendiente"><span class="icon-proyectos_verde"></span>&nbsp;Santander<br>
        <span class="icon-subproyectos_verde"></span>&nbsp;Resultados<br>
        <span class="icon-viaje_verde"></span>&nbsp;Chihuahua</td>
      <td class="status_pendiente">CFDI en búsqueda</td>
      <td class="status_pendiente">Alimentos</td>
      <td class="status_pendiente"><input type="text" class="form-search3" style="font-size: 12px"></td>
      <td class="status_pendiente"><input type="text" class="form-search3" style="font-size: 12px" placeholder="$"></td>
      <td class="status_comprobacion_pendiente"><input type="text" class="form-search3" style="font-size: 12px" placeholder="$"></td>
      <td class="status_pendiente"><input type="text" class="form-search3" style="font-size: 12px" placeholder="$"></td>
      <td class="confirmacion-pendiente"><span class="icon-fr_pendiente icon-tam5"></span></td>
      <td class="metodo_pago"><span class="icon-pago_deposito icon-tam4"></span><br>
        Depósito</td>
      <td class="acciones_botones"><span class="icon-icono_guardar"></span></td>
      <td class="acciones_botones"><span class="icon-icono_enviar"></span></td>
      <td class="acciones_botones"><span class="icon-nota"></span></td>
      <td class="acciones_botones"><span class="icon-icono_mapa"></span></td>
    </tr>
    <tr>
      <td class="status_confirmado"><span class="icon-proyectos_verde"></span>&nbsp;Santander<br>
        <span class="icon-subproyectos_verde"></span>&nbsp;Ventas Evaluación<br>
        <span class="icon-viaje_verde"></span>&nbsp;Chihuahua</td>
      <td class="status_confirmado">CFDI encontrado</td>
      <td class="status_confirmado">Transporte Aéreo</td>
      <td class="status_confirmado"><input type="text" class="form-search3" style="font-size: 12px"></td>
      <td class="status_confirmado"><input type="text" class="form-search3" style="font-size: 12px" placeholder="$"></td>
      <td class="status_comprobacion_pendiente"><input type="text" class="form-search3" style="font-size: 12px" placeholder="$"></td>
      <td class="status_confirmado"><input type="text" class="form-search3" style="font-size: 12px" placeholder="$"></td>
      <td class="confirmacion-pendiente"><span class="icon-fr_encontrado icon-tam5"></span></td>
      <td class="metodo_pago"><span class="icon-efectivo icon-tam5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span><span class="path11"></span><span class="path12"></span></span><br>
        Efectivo</td>
      <td class="acciones_botones"><span class="icon-icono_guardar"></span></td>
      <td class="acciones_botones"><span class="icon-icono_enviar"></span></td>
      <td class="acciones_botones"><span class="icon-nota"></span></td>
      <td class="acciones_botones"><span class="icon-icono_mapa"></span></td>
    </tr>
    <tr>
      <td class="status_confirmado"><span class="icon-proyectos_verde"></span>&nbsp;Pfizer<br>
        <span class="icon-subproyectos_verde"></span>&nbsp;Congreso Anual<br>
        <span class="icon-viaje_verde"></span>&nbsp;Acapulco, Gro</td>
      <td class="status_confirmado">Anticipo</td>
      <td class="status_confirmado">Gasolina, Alimentos</td>
      <td class="status_confirmado"><input type="text" class="form-search3" style="font-size: 12px"></td>
      <td class="status_confirmado"><input type="text" class="form-search3" style="font-size: 12px" placeholder="$"></td>
      <td class="status_comprobacion_pendiente"><input type="text" class="form-search3" style="font-size: 12px" placeholder="$"></td>
      <td class="status_confirmado"><input type="text" class="form-search3" style="font-size: 12px" placeholder="$"></td>
      <td class="confirmacion-pendiente"><span class="icon-circulo_confirmado icon-tam5"></span></td>
      <td class="metodo_pago"><span class="icon-pago_transferencia icon-tam4"></span><br>
        Transferencia</td>
      <td class="acciones_botones"><span class="icon-icono_guardar"></span></td>
      <td class="acciones_botones"><span class="icon-icono_enviar"></span></td>
      <td class="acciones_botones"><span class="icon-nota"></span></td>
      <td class="acciones_botones"><span class="icon-icono_mapa"></span></td>
    </tr>
    <tr>
      <td class="status_rechazado"><span class="icon-proyectos_verde"></span>&nbsp;Pfizer<br>
        <span class="icon-subproyectos_verde"></span>&nbsp;Resultados<br>
        <span class="icon-viaje_verde"></span>&nbsp;Puebla</td>
      <td class="status_rechazado">Comprobables</td>
      <td class="status_rechazado">Transporte Terrestre</td>
      <td class="status_rechazado"><input type="text" class="form-search3" style="font-size: 12px"></td>
      <td class="status_rechazado"><input type="text" class="form-search3" style="font-size: 12px" placeholder="$"></td>
      <td class="status_comprobacion_pendiente"><input type="text" class="form-search3" style="font-size: 12px" placeholder="$"></td>
      <td class="status_rechazado"><input type="text" class="form-search3" style="font-size: 12px" placeholder="$"></td>
      <td class="confirmacion-pendiente"><span class="icon-circulo_rechazado icon-tam5"></span></td>
      <td class="metodo_pago"><span class="icon-pago_transferencia icon-tam4"></span><br>
        Transferencia</td>
      <td class="acciones_botones"><span class="icon-icono_guardar"></span></td>
      <td class="acciones_botones"><span class="icon-icono_enviar"></span></td>
      <td class="acciones_botones"><span class="icon-nota"></span></td>
      <td class="acciones_botones"><span class="icon-icono_mapa"></span></td>
    </tr>
    <tr>
      <td class="status_rechazado"><span class="icon-proyectos_verde"></span>&nbsp;Pfizer<br>
        <span class="icon-subproyectos_verde"></span>&nbsp;Ventas Evaluación<br>
        <span class="icon-viaje_verde"></span>&nbsp;Veracruz</td>
      <td class="status_rechazado">No Comprobables</td>
      <td class="status_rechazado">NA</td>
      <td class="status_rechazado"><input type="text" class="form-search3" style="font-size: 12px"></td>
      <td class="status_rechazado"><input type="text" class="form-search3" style="font-size: 12px" placeholder="$"></td>
      <td class="status_comprobacion_pendiente"><input type="text" class="form-search3" style="font-size: 12px" placeholder="$"></td>
      <td class="status_rechazado"><input type="text" class="form-search3" style="font-size: 12px" placeholder="$"></td>
      <td class="confirmacion-pendiente"><span class="icon-circulo_rechazado icon-tam5"></span></td>
      <td class="metodo_pago"><span class="icon-pago_transferencia icon-tam4"></span><br>
        Transferencia</td>
      <td class="acciones_botones"><span class="icon-icono_guardar"></span></td>
      <td class="acciones_botones"><span class="icon-icono_enviar"></span></td>
      <td class="acciones_botones"><span class="icon-nota"></span></td>
      <td class="acciones_botones"><span class="icon-icono_mapa"></span></td>
    </tr>
    <tr>
      <td class="status_confirmado"><span class="icon-proyectos_verde"></span>&nbsp;Pfizer<br>
        <span class="icon-subproyectos_verde"></span>&nbsp;Congreso Anual<br>
        <span class="icon-viaje_verde"></span>&nbsp;Acapulco, Gro</td>
      <td class="status_confirmado">Monto enviado autorizado</td>
      <td class="status_confirmado">Transporte Terrestre</td>
      <td class="status_confirmado"><input type="text" class="form-search3" style="font-size: 12px"></td>
      <td class="status_confirmado"><input type="text" class="form-search3" style="font-size: 12px" placeholder="$"></td>
      <td class="status_comprobacion_pendiente"><input type="text" class="form-search3" style="font-size: 12px" placeholder="$"></td>
      <td class="status_confirmado"><input type="text" class="form-search3" style="font-size: 12px" placeholder="$"></td>
      <td class="confirmacion-pendiente"><span class="icon-circulo_confirmado icon-tam5"></span></td>
      <td class="metodo_pago"><span class="icon-pago_recibo icon-tam4"></span></span><br>
        Recibo Nómina</td>
      <td class="acciones_botones"><span class="icon-icono_guardar"></span></td>
      <td class="acciones_botones"><span class="icon-icono_enviar"></span></td>
      <td class="acciones_botones"><span class="icon-nota"></span></td>
      <td class="acciones_botones"><span class="icon-icono_mapa"></span></td>
    </tr>
    <tr>
      <td class="status_confirmado"><span class="icon-proyectos_verde"></span>&nbsp;Pfizer<br>
        <span class="icon-subproyectos_verde"></span>&nbsp;Resultados<br>
        <span class="icon-viaje_verde"></span>&nbsp;Querétaro</td>
      <td class="status_confirmado">Recepción de saldo</td>
      <td class="status_confirmado">Hospedaje</td>
      <td class="status_confirmado"><input type="text" class="form-search3" style="font-size: 12px"></td>
      <td class="status_confirmado"><input type="text" class="form-search3" style="font-size: 12px" placeholder="$"></td>
      <td class="status_comprobacion_pendiente"><input type="text" class="form-search3" style="font-size: 12px" placeholder="$"></td>
      <td class="status_confirmado"><input type="text" class="form-search3" style="font-size: 12px" placeholder="$"></td>
      <td class="confirmacion-pendiente"><span class="icon-circulo_confirmado icon-tam5"></span></td>
      <td class="metodo_pago"><br>
        Variable</td>
      <td class="acciones_botones"><span class="icon-icono_guardar"></span></td>
      <td class="acciones_botones"><span class="icon-icono_enviar"></span></td>
      <td class="acciones_botones"><span class="icon-nota"></span></td>
      <td class="acciones_botones"><span class="icon-icono_mapa"></span></td>
    </tr>
    <tr>
      <td class="status_pendiente"><span class="icon-proyectos_verde"></span>&nbsp;Toyota<br>
        <span class="icon-subproyectos_verde"></span>&nbsp;Ventas Evaluación<br>
        <span class="icon-viaje_verde"></span>&nbsp;Toluca 2017</td>
      <td class="status_pendiente">Transferencia de saldo</td>
      <td class="status_pendiente">Renta de Auto</td>
      <td class="status_pendiente"><input type="text" class="form-search3" style="font-size: 12px"></td>
      <td class="status_pendiente"><input type="text" class="form-search3" style="font-size: 12px" placeholder="$"></td>
      <td class="status_comprobacion_pendiente"><input type="text" class="form-search3" style="font-size: 12px" placeholder="$"></td>
      <td class="status_pendiente"><input type="text" class="form-search3" style="font-size: 12px" placeholder="$"></td>
      <td class="confirmacion-pendiente"><span class="icon-circulo_pendiente icon-tam5"></span></td>
      <td class="metodo_pago"><span class="icon-pago_recibo icon-tam4"></span></span><br>
        Recibo Nómina</td>
      <td class="acciones_botones"><span class="icon-icono_guardar"></span></td>
      <td class="acciones_botones"><span class="icon-icono_enviar"></span></td>
      <td class="acciones_botones"><span class="icon-nota"></span></td>
      <td class="acciones_botones"><span class="icon-icono_mapa"></span></td>
    </tr>
  </tbody>
</table>
		
	</div>
	<div class="row">
		<div class="col-md-12 col-xs-12">
			<div class="col-md-6 col-xs-6 totales">
			<span class="icon-transferir_saldo icon-tam6"></span>
			<br>
			TRANSFERIR SALDO
			</div>
			<div class="col-md-6 col-xs-6 totales">
			<div id="total">$0</div>
                    			<br>
                  				TOTAL
			</div>
		</div>
	</div>
</div>

	<script>
		$(document).ready(function(){

            $("#datepicker_inicio").datepicker({
                minDate: 0,
                onSelect: function(selected,evnt) {
                    $fecha_fin= $('#datepicker_fin').val().trim();
                    $fecha_inicio = $(this).val().trim();

                    if($fecha_inicio != '' && $fecha_fin != ''){
                        $finSplit = $fecha_fin.split('/');
                        $inicioSplit = $fecha_inicio.split('/');
                        $dias =parseInt($finSplit[1]) - parseInt($inicioSplit[1]);
                        $('.numero-dias').text($dias);
                        $('.numero-dias-txt').val($dias);
                    }
                }
            });
            $("#datepicker_fin").datepicker({
                minDate: 0,
                onSelect: function(selected,evnt) {
                    $fecha_inicio = $('#datepicker_inicio').val().trim();
                    $fecha_fin = $(this).val().trim();
                    if($fecha_inicio != '' && $fecha_fin != '') {
                        $finSplit = $fecha_fin.split('/');
                        $inicioSplit = $fecha_inicio.split('/');
                        $dias = parseInt($finSplit[1]) - parseInt($inicioSplit[1]);
                        $('.numero-dias').text($dias);
                        $('.numero-dias-txt').val($dias);
                    }
                }
            });

		    var pathProject = "{{ route('autocomplete_project_acount') }}";
            $('.search_project').typeahead({
                source:  function (query, process) {
                    return $.get(pathProject, { query: query }, function (data) {
                        //console.log(data);
                        return process(data);
                    });
                },updater:function (selection) {
                    $('#project_id').val(selection.id);
                    return selection.name;
                }
            });

            var pathSubproject ="{{ route('autocomplete_subproject_acount') }}";
            $('.search_subproject').typeahead({
                source:  function (query, process) {
                    return $.get(pathSubproject, {
                        	query: query
					}, function (data) {
                        return process(data);
                    });
                },updater:function (selection) {
                    $('#subproject_id').val(selection.id);
                    $('#project_id').val(selection.proyecto.id);
                    $('#proyecto_name').val(selection.proyecto.name);
                    return selection.name;
                }
            });
            var pathTravel ="{{ route('autocomplete_travel_acount') }}";
            $('.search_travel').typeahead({
                source:  function (query, process) {
                    return $.get(pathTravel,
                        {
                            query: query,

                        }, function (data) {
                            return process(data);
                        });
                },updater:function (selection) {
                    console.log(selection);
                    $('#travel_id').val(selection.id);
                    $('#subproject_id').val(selection.subproyecto.id);
                    $('#subproyecto_name').val(selection.subproyecto.name);
                    $('#project_id').val(selection.proyecto.id);
                    $('#proyecto_name').val(selection.proyecto.name);
                    return selection.name;
                }
            });
		});
	</script>



@endsection

