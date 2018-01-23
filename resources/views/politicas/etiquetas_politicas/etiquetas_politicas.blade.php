@extends('template.dashboard-container')
@section('content')
    <style>
        .icon-tam {
            font-size: 25px;
			padding-left: 10px;
        }
		
		.icon-tam2 {
            font-size: 40px;
			padding-left: 10px;
			text-align: center;
        }
		
		.nombre-etiquetas{
			
			background: #e2e2e1;
			border-top-left-radius:10px;
			border-bottom-left-radius: 10px;
			padding: 1.5%;
			color:#303082;
			font-size: 14px;
			text-align: left;
		}
		
		.nombre-etiquetas2{
			
			background: #e2e2e1;
			border-radius: 10px;
			padding: 1.5%;
			color:#303082;
			font-size: 14px;
			text-align: center;
		}
		
		
		
		.viaje-etiquetas{
			
			background: #e2e2e1;
			border-top-right-radius:10px;
			border-bottom-right-radius: 10px;
			padding: 1.5%;
			color:#303082;
			font-size: 14px;
			text-align: left;
		}
		#etiquetas-agregadas{
			height:auto;
			overflow: auto;
		}
		
		
		
    </style>
    
    <div class="row titulo-pantalla">
        <div class="col-md-12 col-sm-12 col-xs-6 center">
            <div class="about-item scrollpoint sp-effect2" style="text-align: center;padding-top: 44px;">
			<span class="icon-icon_etiquetas icon-tam2"></span>ETIQUETAS</div>
        </div>
    </div>
    <br><br>
    <div class="row">
        
        <div class="col-sm-6">
            <div class="col-sm-12">
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
        </div>

    </div>

    <div class="row" style="margin-top: 2%">

        <div class="col-sm-12">

            <div class="col-sm-4">
                
                <div class="col-sm-12">
                    
                    <div class="row" style="cursor: pointer;" onclick="toggle_mostrar(['seccion_predeterminadas'])">
                        <div class="title-row">
                            <span class="icon-icon_prederminadoagregar icon-tam"></span> 
                            Predeterminadas
                        </div>
                    </div>
                    <div class="row" id="seccion_predeterminadas" style="display: none;">
                            <div class="col-md-12 col-xs-12 nombre-etiquetas2">Nombre 
                                <!-- <span  etiqueta="predeterminadas" class="icon-mas icon-tam etiquetas" style="cursor: pointer;">
                                    <span class="path1"></span><span class="path2"></span>
                                </span> -->
                            </div>
                            {!! $table_etiquetas !!}
                    </div>
                    <br><br>
                    <div class="row" style="cursor: pointer;" onclick="toggle_mostrar(['seccion_corporativas'])">
                        <div class="title-row ">
                            <span class="icon-icon_corporativas icon-tam"></span> 
                            Corporativas
                        </div>
                    </div>
                    <div class="row" id="seccion_corporativas" style="display: none;">
                        <div class="col-md-12 col-xs-12 nombre-etiquetas2">Nombre 
                            <span  etiqueta="corporativas" class="icon-mas icon-tam etiquetas" style="cursor: pointer;">
                                <span class="path1"></span><span class="path2"></span>
                            </span>
                        </div>
                        {!! $table_corporativas !!}
                    </div>
                    <br><br>
                    <div class="row" style="cursor: pointer;" onclick="toggle_mostrar(['seccion_usuario'])">
                        <div class="title-row">
                           <span class="icon-icon_dispositivousuario icon-tam"></span> 
                            Usuario
                        </div>
                    </div>
                    <div class="row" id="seccion_usuario" style="display: none;">
                        <div class="col-md-12 col-xs-12 nombre-etiquetas2">Nombre 
                            <span etiqueta="usuario" class="icon-mas icon-tam etiquetas" style="cursor: pointer;">
                                <span class="path1"></span><span class="path2"></span>
                            </span>
                        </div>
                        {!! $table_usuario !!}
                    </div>

                </div>

            </div>
            <!-- inicia seccion del formulario -->
            <div class="col-sm-8 panel panel-default" id="formulario_etiquetas">

                <h3 class="font_menu" id="titulo_form">DETALLE DE ETIQUETAS</h3><br><br>
                <input type="hidden" value="" id="id_etiqueta">
                <input type="hidden" value="" id="id_politica">
                <div class="col-sm-12">
                    
                    <div class="col-sm-5">
                        
                        <form class="form-horizontal">
                            <div class="form-group">
                              <label class="control-label col-sm-2 conten-img-title" for="pwd">Logo:</label>
                              <div class="col-sm-10">          
                                <input type="hidden" id="etiqueta_img">
                                <div id="div_dropzone_file"></div>

                              </div>
                            </div>
                        </form>

                    </div>

                    <div class="col-sm-7">
                        
                        <div id="img_seccion"></div>

                        <form class="form-horizontal">
                            <div class="form-group">
                              <label class="control-label col-sm-6 conten-img-title" >Nombre de Etiqueta:</label>
                              <div class="col-sm-6">          
                                <input type="text" class="form-control" placeholder="Ingrese Nombre" id="etiqueta_nombre">
                              </div>
                            </div>
                        </form>

                    </div>


                    <div class="row">
                        
                        <div class="col-sm-9">
                        
                        <form class="form-horizontal">
                            <div class="form-group">
                              <label class="control-label col-sm-2 conten-img-title" for="pwd">Descripcion:</label>
                              <div class="col-sm-10">          
                                <textarea class="form-control" id="etiqueta_descripcion"></textarea>
                              </div>
                            </div>
                        </form>

                        </div>

                        <div class="col-sm-3">
                            
                            <form class="form-horizontal">
                                <div class="form-group">

                                  <div class="col-sm-12">          
                                    <select class="form-control" id="etiqueta_tipo" disabled="">
                                        <option value="predeterminadas">Predeterminadas</option>
                                        <option value="corporativas">Corporativas</option>
                                        <option value="usuario">Usuario</option>
                                    </select>
                                  </div>
                                </div>
                            </form>

                        </div>

                    </div>

                    <div class="row">
                        
                        <div class="col-sm-offset-4 col-sm-4">
                        
                        <form class="form-horizontal">
                            <div class="form-group">
                              <label class="control-label col-sm-2 font_menu" >Nacional</label>
                            </div>
                        </form>

                        </div>

                        <div class="col-sm-4">
                            
                            <form class="form-horizontal">
                                <div class="form-group">
                                  <label class="control-label col-sm-2 font_menu" >Extranjero</label>
                                </div>
                            </form>

                        </div>

                    </div>


                      <div class="row">
                        
                        <div class="col-sm-7">
                        
                        <form class="form-horizontal">
                            <div class="form-group">
                              <label class="control-label col-sm-5 conten-img-title">Monto maximo fiscal diario:</label>
                              <div class="col-sm-7">
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="text" class="form-control" onkeyup="numerico(this)" id="importe_ded_nal" placeholder="$" value="0">
                                </div>
                              </div>
                            </div>
                        </form>

                        </div>

                        <div class="col-sm-5">
                            
                            <form class="form-horizontal">
                                <div class="form-group">
                                  <div class="col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                        <input type="text" name="" class="form-control" onkeyup="numerico(this)" id="importe_ded_ext" placeholder="$" value="0">
                                    </div>          
                                  </div>
                                </div>
                            </form>

                        </div>


                    </div>


                      <div class="row">
                        
                        <div class="col-sm-7">
                        
                        <form class="form-horizontal">
                            <div class="form-group">
                              <label class="control-label col-sm-5 conten-img-title">Monto maximo corporativo:</label>
                              <div class="col-sm-7">
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="text" name="" class="form-control" id="importe_emp_nal" onkeyup="numerico(this)" placeholder="$" value="0">
                                </div>          
                              </div>
                            </div>
                        </form>

                        </div>

                        <div class="col-sm-5">
                            
                            <form class="form-horizontal">
                                <div class="form-group">
                                  <div class="col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                        <input type="text"  class="form-control" id="importe_emp_ext" onkeyup="numerico(this)" id="" placeholder="$" value="0">
                                    </div>
                                  </div>
                                </div>
                            </form>

                        </div>

                    </div>

                    <br>
                    <div class="row">
                        <div class="pull-right">
                            <button type="button" class="btn btn-success" id="save_politicas" onclick="save_politicas()">Agregar</button>
                            <button type="button" class="btn btn-success" id="update_politicas" style="display: none;" onclick="update_politicas()">Actualizar</button>
                            <button type="button" class="btn btn-danger" onclick="mostrar_elements([],['formulario_etiquetas'])">Cancelar</button>
                        </div>

                    </div>


                </div>

            </div>

        </div>

    </div>


    <script type="text/javascript" src="{{ asset('js/etiquetas_politicas/etiquetas_politicas.js') }}"></script>


@endsection