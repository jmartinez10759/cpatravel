@extends('template.dashboard-container')
@section('content')
<input type="hidden" id="show_url" value="{{ $solicitud_show }}">
<input type="hidden" id="return" value="{{ $return }}">
<input type="hidden" id="id_solicitud" value="">
<input type="hidden" id="id_viatico" value="">
<input type="hidden" id="id_detalle" value="">
    <div class="container">
        <div class="col-sm-12">
            <div class="row" id="seccion_solicitud">
                <!--SE CARGA LA FILA CONTENEDORA DE TODO EL FORMULARIO-->
                <div class="row titulo-pantalla">
                    <div class="col-xs-12 col-sm-12 col-md-12 "><span class="icon-tit_solicitud icon-tam2"></span> {{$titulo_principal}}</div>
                </div>
            <br>
        <div class="row">

            <div class="col-sm-12">

                <div class="col-sm-4">
                    <div class="col-sm-12">
                        <div class="col-sm-5">
                            <div class="conten-img">
                                <img alt="User Pic" src="{{$avatar}}" class="img-circle img-responsive img-profile">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="conten-img-title">
                                USUARIO: {{$usuario}}
                            </div>
                        </div>
                    </div>
                </div>
<!-- sugunda seccion actual -->
                <div class="col-sm-1">
                    <div class="row"> <label class="control-label">Fecha </label> </div>
                    <div class="row"> <label class="control-label">Horario </label> </div>
                    <div class="row"> <label class="control-label">Destino </label> </div>
                </div>
<!-- tercera seccion actual -->
                <div class="col-sm-3">
                    
                    <div class="row"> 
                        <form class="form-inline">
                            <div class="form-group">
                                <label class="control-label"><i class="icon-calendario"></i> Inicio</label>
                                &nbsp;&nbsp;&nbsp;
                                <input type="text" class="form-control-sm" id="datepicker_inicio" value="{{date("d-m-Y")}}">
                            </div>
                        </form>
                    </div>

                    <div class="row"> 
                        <form class="form-inline">
                            <div class="form-group">
                                <label class="control-label"><i class="icon-reloj"></i> Salida </label>
                                &nbsp;&nbsp;
                                {!! $horario !!}
                            </div>
                        </form>
                    </div>

                    <div class="row"> 
                        <form class="form-inline">
                            <div class="form-group">
                                <label class="control-label"><i class="icon-ubicacion"></i> Origen </label>
                                &nbsp;&nbsp;&nbsp;
                                {!! $country_inicio !!}
                            </div>
                        </form>
                    </div>

                </div>
<!-- cuarta seccion actual -->
                <div class="col-sm-3">
                    
                    <div class="row"> 
                        <form class="form-inline">
                            <div class="form-group">
                                <label class="control-label"><i class="icon-calendario"></i> Fin</label>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="text" class="form-control-sm" id="datepicker_fin" value="{{ date("d-m-Y",strtotime('+1 day'))  }}" >
                            </div>
                        </form>
                    </div>

                    <div class="row"> 
                        <form class="form-inline">
                            <div class="form-group">
                                <label class="control-label"><i class="icon-reloj"></i> Regreso </label>
                                &nbsp;&nbsp;
                                {!! $hora_final !!}
                            </div>
                        </form>
                    </div>

                    <div class="row"> 
                        <form class="form-inline">
                            <div class="form-group">
                                <label class="control-label"><i class="icon-ubicacion"></i> Destino </label>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                {!! $country_final !!}
                            </div>
                        </form>
                    </div>

                </div>
            <!-- quita seccion actualizada -->
                <div class="col-sm-1">
                    
                    <span id="dias">
                        <span class="label-dia">
                          <div class="row numero-dias">
                          </div>
                          <div class="row dias-txt">
                            días
                          </div>
                        </span>
                    </span>

                </div>
            <!-- fin de las secciones -->
            </div>
        </div>
    <!--SEGUNDA FILA DEL FORMULARIO DE VIATICOS-->
        <div class="row">
            <div class="col-sm-12">
                <div class="col-sm-3">
                    <div class="col-sm-12">
                        <div class="row">
                            <label class="label-fechas"><i class="icon-proyectos"></i> Proyecto</label>
                        </div>
                        <div class="row">
                            {!! $proyectos !!}
                        </div>
                    </div>
                </div>

                <div class="col-sm-3">
                        <div class="col-sm-12">
                            <div class="row">
                                <label class="label-fechas"><i class="icon-subproyectos"></i> Sub Proyecto</label>
                            </div>
                            <div class="row">
                                {!! $subproyectos !!}
                            </div>
                        </div>
                </div>

                <div class="col-sm-3">
                    <div class="col-sm-12">
                        <div class="row">
                            <label class="label-fechas"><i class="icon-viaje"></i> Viajes</label>
                        </div>
                        <div class="row">
                            {!! $viajes !!}
                        </div>
                    </div>
                </div>

                <div class="col-sm-3">
                        <div class="col-sm-12">
                            <label class="label-fechas"><i class="icon-acompanantes"></i> Acompañantes</label>
                            <select class="" id="user" multiple="multiple">
                               @foreach( $usuarios as $user )
                                <option value="{{ $user['id'] }}">{{$user['name']}}</option>
                               @endforeach
                           </select>
                        </div>
                </div>
            </div>
        </div>
        <!-- TERCERA FILA -->
        <div class="row" style="margin-top: 20px;">
            <div class="col-sm-12">
                <div class="col-sm-2">
                    <!-- <h5> {{$leyenda}} </h5> -->
                    <div class="col-sm-6" style="width: 65px;">
                        @foreach($etiquetas as $etiqueta)
                            @if( $etiqueta->id_etiqueta%2)
                                <div class="row">
                                    <a id="{{$etiqueta->id_etiqueta}}" url="{{ $viaticos }}" onclick="select_viatico(this)">
                                        <div class="col-md-5 col-sm-5 element-div" data-toggle="tooltip" title="{{$etiqueta->etiqueta_nombre}}" >
                                            <!-- <span class="{{ $etiqueta->etiqueta_img }} element-viatico">
                                                <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span><span class="path11"></span>
                                            </span> -->
                                            <img src="{{ $etiqueta->etiqueta_img }}">
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="col-sm-6">
                        @foreach($etiquetas as $etiqueta)
                            @if( $etiqueta->id_etiqueta%2 == 0)
                                <div class="row">
                                    <a id="{{$etiqueta->id_etiqueta}}" url="{{ $viaticos }}" onclick="select_viatico(this)" >
                                    <div class="col-md-5 col-sm-5 element-div" data-toggle="tooltip" title="{{ $etiqueta->etiqueta_nombre }}">
                                        <!-- <span class="fa {{ $etiqueta->etiqueta_img }} element-viatico" tooltip="{{ $etiqueta->etiqueta_nombre }}">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span><span class="path11"></span>
                                        </span> -->
                                        <img src="{{ $etiqueta->etiqueta_img }}">
                                    </div>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- SEGUNDA COLUMNA -->
                <div class="col-sm-3">
                    <div class="col-sm-12" style="height:350px; overflow-y:auto;">
                        <div class="row">
                            <div class="panel panel-default" style="background: transparent; border-color: #099C7F; border-radius: 12px;">
                                <div class="panel-body">
                                     <table class="table table-hover table-responsive" id="table_body_concepto">
                                            <thead>
                                                <tr>
                                                    <th>Concepto</th>
                                                    <th>Monto</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                            <tfoot>
                                                <tr>
                                                    <td class="pull-right">TOTAL: </td>
                                                    <td class="total_importe"> </td>
                                                </tr>
                                            </tfoot>
                                    </table>   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- TERCERA COLUMNA -->
                <div class="col-sm-7">
                    <div class="col-sm-12">
                        <div class="row">
                           <div class="table-responsive">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tbody>
                                    <tr>
                                      <td width="10%">&nbsp;</td>
                                      <td width="15%">
                                          <div id="tabla-cheques">
                                          <span class="icon-cheques">
                                              </span>
                                              <span title-button><br>Cheques </span>
                                          </div>
                                      </td>
                                      <td width="15%">
                                          <div id="tabla-debito">
                                              <span class="icon-tarjeta">
                                              </span>
                                              <span title-button><br>
                                              Débito
                                              </span>
                                          </div>
                                      </td>
                                      <td width="16%">
                                          <div id="tabla-credito">
                                              <span class="icon-tarjeta">
                                              </span>
                                              <span title-button><br>
                                              Crédito
                                              </span>
                                          </div>
                                      </td>
                                      <td width="15%">
                                          <div id="tabla-efectivo">
                                              <span class="icon-efectivo" ><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span><span class="path11"></span><span class="path12"></span></span>
                                              <span title-button><br>
                                              Efectivo
                                              </span>
                                          </div>
                                      </td>
                                      <td width="16%">
                                          <div id="tabla-amex">
                                              <span class="icon-tarjeta">
                                              </span>
                                              <br>
                                              Corporativa
                                          </div>
                                      </td>
                                      <td width="13%">&nbsp;</td>
                                    </tr>
                                    <tr class="tr_solicitados_monto_nacional" id="">
                                        <td rowspan="2"><div id="nacional">Nacional</div></td>
                                        <td><input type="text" placeholder="$" readonly="readonly" id="tr_solicitados_monto_nacional_1" monto_tipo_pago="Cheques" class="form-search2" value="0"></td>
                                        <td><input type="text" placeholder="$" readonly="readonly" id="tr_solicitados_monto_nacional_2" monto_tipo_pago="Debito" class="form-search2" value="0"></td>
                                        <td><input type="text" placeholder="$" readonly="readonly" id="tr_solicitados_monto_nacional_3" monto_tipo_pago="Credito" class="form-search2" value="0"></td>
                                        <td><input type="text" placeholder="$" readonly="readonly" id="tr_solicitados_monto_nacional_4" monto_tipo_pago="Efectivo" class="form-search2" value="0"></td>
                                        <td><input type="text" placeholder="$" readonly="readonly" id="tr_solicitados_monto_nacional_5" monto_tipo_pago="Corporativa" class="form-search2" value="0"></td>
                                        <td>Monto solicitado</td>
                                    </tr>
                                    <tr class="tr_solicitados_monto_nacional hidden">
                                        <td><input type="text" placeholder="$" readonly="readonly" id="nacional_cheques_auto" name="nacional_cheques_auto" class="form-search2" ></td>
                                        <td><input type="text" placeholder="$" readonly="readonly" id="nacional_debito_auto" name="nacional_debito_auto" class="form-search2"></td>
                                        <td><input type="text" placeholder="$" readonly="readonly" id="nacional_credito_auto" name="nacional_credito_auto" class="form-search2"></td>
                                        <td><input type="text" placeholder="$" readonly="readonly" id="nacional_efectivo_auto" name="nacional_efectivo_auto" class="form-search2"></td>
                                        <td><input type="text" placeholder="$" readonly="readonly" id="nacional_amex_auto" name="nacional_amex_auto" class="form-search2"></td>
                                        <td>Monto Autorizado</td>
                                    </tr>
                                    <tr>
                                        <td colspan="7">
                                          <hr>
                                        </td>
                                    </tr>
                                    <tr class="tr_solicitados_monto_extranjero">
                                        <td rowspan="2"><div id="extranjero"> Extranjero </div></td>
                                        <td><input type="text" placeholder="$" readonly="readonly" id="tr_solicitados_monto_extranjero_1" class="form-search2" value="0"></td>
                                        <td><input type="text" placeholder="$" readonly="readonly" id="tr_solicitados_monto_extranjero_2" class="form-search2" value="0"></td>
                                        <td><input type="text" placeholder="$" readonly="readonly" id="tr_solicitados_monto_extranjero_3" class="form-search2" value="0"></td>
                                        <td><input type="text" placeholder="$" readonly="readonly" id="tr_solicitados_monto_extranjero_4" class="form-search2" value="0"></td>
                                        <td><input type="text" placeholder="$" readonly="readonly" id="tr_solicitados_monto_extranjero_5" class="form-search2" value="0"></td>
                                        <td>Monto solicitado</td>
                                    </tr>
                                    <tr class="tr_solicitados_monto_extranjero hidden">
                                        <td><input type="text" placeholder="$" readonly="readonly" id="extranjero_cheques_auto" name="extranjero_cheques_auto" class="form-search2" ></td>
                                        <td><input type="text" placeholder="$" readonly="readonly" id="extranjero_debito_auto" name="extranjero_debito_auto" class="form-search2"></td>
                                        <td><input type="text" placeholder="$" readonly="readonly" id="extranjero_credito_auto" name="extranjero_credito_auto" class="form-search2"></td>
                                        <td><input type="text" placeholder="$" readonly="readonly" id="extranjero_efectivo_auto" name="extranjero_efectivo_auto" class="form-search2"></td>
                                        <td><input type="text" placeholder="$" readonly="readonly" id="extranjero_amex_auto" name="extranjero_amex_auto" class="form-search2"></td>
                                        <td>Monto Autorizado</td>
                                    </tr>
                                  </tbody>
                                </table>
                            </div>


                                <div class="row" id="send_solicitud">
                            <input type="hidden" name="request_id" id="request_id">
                            <div class="col-md-12 col-xs-12">
                                <div class="row"> 
                                    <div class="col-sm-12">
                                        <div class="col-sm-3 center">
                                             <div id="total" class="total_solicitud"><span class="total_importe">0</span></div>
                                                <input type="hidden" name="total_solicitud_txt" id="total_solicitud_txt" class="total_solicitud_txt">
                                                <br>
                                                TOTAL
                                        </div>

                                        <div class="col-sm-5 center">
                                            <div class="col-sm-12">

                                                <div class="col-sm-6">
                                                    <button type="button" id="save_solicitud" url="{{ $cargar_solicitud }}"  class="btn btn-danger" onclick="save_solicitud(this)">Guardar Solicitud</button>
                                                </div>
                                                <div class="col-sm-6" >
                                                    <button type="button" url="{{ $cargar_solicitud }}" class="btn btn-info" onclick="send_solicitud(this)" disabled="" id="send_solicitudes" style="display: none;">Guardar Solicitud</button>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-sm-4 center">
                                                <div id="autorizacion">
                                                    <span class="icon-acompanantes" style="font-size: 60px;">

                                                    </span>
                                                </div>
                                                <input type="hidden" name="user_id_autorization" id="user_id_autorization" value="af125f96-6750-44c2-bdde-67b9d23b131e" class="user_id_autorization">
                                                <br>
                                                Pendiente por Autorizar {{ $modeladoStage->supervisor }}
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

                <!-- FIN DE LA SECCION DE LA CARGA DE TODO EL FORMULARIO-->
            </div>


            <div class="row" style="display: none;" id="seccion_viaticos">
                <!--SE CARGA LA FILA CONTENEDORA DE EL FORMULARIO DE VIATICOS-->
                <!-- <div id="contenido_viatico" ></div> -->
                <div class="col-sm-12">

                    <div class="row" id="seccion_viatico_table">

                        <center><h3 id="name_viatico"></h3></center>
                        
                        <div class="collapse in">
                                <div class="col-sm-1 col-sm-offset-10">
                                    <div class="btn-toolbar">
                                        <button class="btn btn-success" onclick="show_form_viaticos(this)"><i class="fa fa-plus-circle"> </i> Agregar Viaticos </button>
                                    </div>
                                    
                                </div>
                        </div>
                        
                        <div class="col-sm-12" style="height:150px; overflow-y:auto;">
                        <!-- <div class="col-sm-12" style="overflow-y:auto;"> -->
                            <table id="table_viaticos_temporal" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Viatico</th>
                                        <th>Cantidad</th>
                                        <th>Unidad</th>
                                        <th>Costo Unitario</th>
                                        <th>Costo Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                            
                        </div>
                        
                    </div>
                    <!--seccion de imagen del viatico-->
                    <br><br>
                    <button type='button' onclick="back_seccion(this)" class='btn btn-primary pull-right'>Regresar</button>
                    <div class="row" style="display: none;" id="seccion_viatico_form">
                            <div class="col-sm-2">
                                <br><br><br><br>
                                <center><div id="etiqueta_img"></div>
                                <h4 id="etiqueta_nombre"></h4></center>
                                 <!-- <span id="etiqueta_img">
                                           <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span><span class="path11"></span>
                                       </span> -->
                            </div>
                            <!--seccion del formulario de los montos-->
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="col-sm-2">
                                           <select class="form-control select-na" id="monto_tipo_solicitud" onchange="change_tipo_solicitud(this)">
                                            <option value="Nacional">Nacional</option>
                                            <option value="Extranjero">Extranjero</option>
                                        </select>  
                                        </div>

                                        <div class="col-sm-5">
                                               <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="col-sm-6">
                                                            <span title-button>Cantidad</span>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <input type="text" id="viatico_cantidad" class="txt-re-col form-control" value="1" onblur="totalViaticos(this)" onkeyup="numerico(this)">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="col-sm-6">
                                                            <span title-button> Unidad </span>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <input type="text" id="viatico_unidad" class=" txt-re-col form-control" value="1" onblur="totalViaticos(this)" onkeyup="numerico(this)">
                                                        </div>
                                                    </div>
                                                </div>      
                                        </div>

                                        <div class="col-sm-5">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="col-sm-6">
                                                            <span title-button> Costo Unitario </span>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="col-sm-12">
                                                                <input type="hidden" id="importe_emp_ext">
                                                                <input type="hidden" id="importe_emp_nal">
                                                                <input type="hidden" id="importe_emp_total" value="0">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">$</span>
                                                                    <input type="text" id="viatico_costo_unitario" class="txt-re-col form-control" value="0" placeholder="$" onblur="totalViaticos(this)" onkeyup="numerico(this)">
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="col-sm-6">
                                                            <span title-button> Costo Total </span> 
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="col-sm-12">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">$</span>
                                                                    <input type="text" id="total_importe" class="form-control txt-re-col total_importe" value="0" placeholder="$" disabled="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>    
                                </div>
                                <br><br><br><br>
                                <div class="row">
                                    <div class="col-sm-12">
                                            <!-- <center><h3>Forma de Pago</h3></center> -->
                                            <div class="row">
                                                <div class="col-sm-offset-5"><h3>Forma de Pago</h3></div>
                                            </div>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>
                                                            <span class="icon-cheques head-icon"></span>
                                                            <span class="txt-icon">Cheques</span>
                                                        </th>
                                                        <th>
                                                            <span class="icon-tarjeta head-icon"></span>
                                                            <span class="txt-icon">Débito</span>
                                                        </th>
                                                        <th>
                                                            <span class="icon-tarjeta head-icon"></span>
                                                            <span class="txt-icon">Crédito</span>
                                                        </th>
                                                        <th>
                                                            <span class="icon-efectivo head-icon">
                                                                <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span><span class="path11"></span><span class="path12"></span>
                                                            </span>
                                                            <span class="txt-icon">Efectivo</span>
                                                        </th>
                                                        <th>
                                                            <span class="icon-tarjeta head-icon"></span>
                                                            <span class="txt-icon">Corporativa</span>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="monto_tipo_solicitud">Nacional</td>
                                                        <td>
                                                            <div class="input-group">
                                                                <span class="input-group-addon">$</span>
                                                                <input type="text" placeholder="$" id="forma_pago_1" monto_tipo_pago="Cheques" class="txt-re-col form-control monto_tipo_pago" value="0" onfocus="value_inputs(this)" onkeyup="numerico(this)">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group">
                                                                <span class="input-group-addon">$</span>
                                                                <input type="text" placeholder="$" id="forma_pago_2" monto_tipo_pago="Debito" class="txt-re-col form-control monto_tipo_pago" value="0" onfocus="value_inputs(this)" onkeyup="numerico(this)">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group">
                                                                <span class="input-group-addon">$</span>
                                                                <input type="text" placeholder="$" id="forma_pago_3" monto_tipo_pago="Credito" class="txt-re-col form-control monto_tipo_pago" value="0" onfocus="value_inputs(this)" onkeyup="numerico(this)">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group">
                                                                <span class="input-group-addon">$</span>
                                                                <input type="text" placeholder="$" id="forma_pago_4" monto_tipo_pago="Efectivo" class="txt-re-col form-control monto_tipo_pago" value="0" onfocus="value_inputs(this)" onkeyup="numerico(this)">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group">
                                                                <span class="input-group-addon">$</span>
                                                                <input type="text" placeholder="$" id="forma_pago_5" monto_tipo_pago="Corporativa" class="txt-re-col form-control monto_tipo_pago" value="0" onfocus="value_inputs(this)" onkeyup="numerico(this)">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>

                                </div>
                                <br>
                                <div class="row">
                                    <button type='button' id="back_seccion" onclick="back_seccion(this)" class='btn btn-sm btn-cancelar pull-right'>Cancelar</button>
                                    <button type='button' id="save_viaticos_solicitud" class='btn btn-sm btn-save pull-right' onclick="save_viaticos_solicitud(this)" > Agregar Viatico</button>
                                    <button type='button' id="actualizar_viaticos" class='btn btn-sm btn-save pull-right' onclick="actualizar(this)"> Actualizar </button>
                                </div>

                            </div>
                            
                            
                    </div>

                </div>

            </div>

        </div>

<script type="text/javascript" src="{{ asset('js/business/solicitud-viaje.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/viaticos/viaticos_montos.js') }}"></script>

@endsection

