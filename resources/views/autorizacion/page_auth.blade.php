@extends('layouts.app')
@section('content')
<input type="text" id="id_solicitud" value="{{ $solicitudes['id_solicitud'] }}">
<input type="hidden" id="extranjeros" value="{{$extranjero}}">
<input type="hidden" id="nacionales" value="{{$nacional}}">
    <div class="container">
      <a href="{{$logout}}"> Logout </a>
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
                        <div class="col-sm-7">
                            <div class="conten-img-title">
                                USUARIO: {{ $solicitudes['usuario'] }}
                            </div>
                        </div>
                    </div>
                </div>
<!-- sugunda seccion actual -->
                <div class="col-sm-1">
                    <div class="row"> <label class="control-label">Fecha </label> </div>
                    <!-- <div class="row"> <label class="control-label">Horario </label> </div> -->
                    <div class="row"> <label class="control-label">Destino </label> </div>
                </div>
<!-- tercera seccion actual -->
                <div class="col-sm-2">
                    
                    <div class="row"> 
                        <form class="form-inline">
                            <div class="form-group">
                                <label class="control-label"><i class="icon-calendario"></i> De</label>
                                &nbsp;&nbsp;&nbsp;
                                {{ $solicitudes['fecha_inicio'] }} {{$solicitudes['horario_salida']}}
                            </div>
                        </form>
                    </div>

                    <div class="row"> 
                        <form class="form-inline">
                            <div class="form-group">
                                <label class="control-label"><i class="icon-ubicacion"></i> De </label>
                                &nbsp;&nbsp;
                                {{$solicitudes['destino_origen']}}
                            </div>
                        </form>
                    </div>

                </div>
<!-- cuarta seccion actual -->
                <div class="col-sm-2">
                    
                    <div class="row"> 
                        <form class="form-inline">
                            <div class="form-group">
                                <label class="control-label"><i class="icon-calendario"></i> A </label>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                {{$solicitudes['fecha_fin']}} {{$solicitudes['horario_regreso']}}
                            </div>
                        </form>
                    </div>

                    <div class="row"> 
                        <form class="form-inline">
                            <div class="form-group">
                                <label class="control-label"><i class="icon-ubicacion"></i> A </label>
                                &nbsp;&nbsp;&nbsp;
                                {{$solicitudes['destino']}}
                            </div>
                        </form>
                    </div>

                </div>
            <!-- quita seccion actualizada -->
                <!-- <div class="col-sm-1">
                    
                    <span id="dias">
                        <span class="label-dia">
                          <div class="row numero-dias">
                          </div>
                          <div class="row dias-txt">
                            días
                          </div>
                        </span>
                    </span>

                </div> -->
            <!-- fin de las secciones -->
            </div>
        </div>    
        <br>
    <!--SEGUNDA FILA DEL FORMULARIO DE VIATICOS-->
        <div class="row">
            <div class="col-sm-12">
                <div class="col-sm-3">
                    <div class="col-sm-12">
                        <div class="row">
                            <label class="label-fechas"><i class="icon-proyectos"></i> Proyecto</label>
                        </div>
                        {{$solicitudes['proyecto']}}
                    </div>
                </div>

                <div class="col-sm-3">
                        <div class="col-sm-12">
                            <div class="row">
                                <label class="label-fechas"><i class="icon-subproyectos"></i> Sub Proyecto</label>
                            </div>
                            {{$solicitudes['subproyecto']}}
                        </div>
                </div>

                <div class="col-sm-3">
                    <div class="col-sm-12">
                        <div class="row">
                            <label class="label-fechas"><i class="icon-viaje"></i> Viajes</label>
                        </div>
                        {{$solicitudes['viajes']}}
                    </div>
                </div>

                <div class="col-sm-3">
                        <div class="col-sm-12">
                            <label class="label-fechas"><i class="icon-acompanantes"></i> Acompañantes</label>
                        </div> 
                        {{$solicitudes['acompanante']}}
                </div>
            </div>
        </div>
        <!-- TERCERA FILA -->
        <div class="row" style="margin-top: 20px;">
            <div class="col-sm-12">
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
                                            <tbody>
                                              @foreach( $viaticos as $response )
                                              <tr>
                                                <td>{{ ($response['viatico']) }}</td>
                                                <td>{{ ($response['viatico_total']) }}</td>
                                              </tr>
                                              @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td class="pull-right">TOTAL: </td>
                                                    <td class="total_importe"> 
                                                      {{ format_currency($solicitudes['total']) }}
                                                    </td>
                                                </tr>
                                            </tfoot>
                                    </table>   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- TERCERA COLUMNA -->
                <div class="col-sm-9">
                    <div class="col-sm-12">
                        <div class="row">
                           <div class="table-responsive">

                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table-responsive table" id="tabla_nacional">
                                <thead>
                                    <tr><div id="nacional">Nacional</div></tr>
                                    <tr>
                                      
                                      <th>
                                        <div id="tabla-cheques">
                                            <span title-button><br>Monto </span>
                                        </div>
                                      </th>
                                      
                                      <th>
                                        <div id="tabla-cheques">
                                            <span class="icon-cheques"></span>
                                            <span title-button><br>Cheques </span>
                                        </div>
                                      </th>

                                      <th>
                                        <div id="tabla-cheques">
                                            <span class="icon-cheques"></span>
                                            <span title-button><br>Débito </span>
                                        </div>
                                      </th>

                                      <th>
                                        <div id="tabla-cheques">
                                            <span class="icon-cheques"></span>
                                            <span title-button><br>Crédito </span>
                                        </div>
                                      </th>

                                      <th>
                                        <div id="tabla-credito">
                                              <span class="icon-efectivo" ><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span><span class="path11"></span><span class="path12"></span></span>
                                              <span title-button><br>
                                              Efectivo
                                              </span>
                                          </div>
                                      </th>

                                      <th>
                                        <div id="tabla-cheques">
                                            <span class="icon-cheques"></span>
                                            <span title-button><br>Corporativa </span>
                                        </div>
                                      </th>

                                      <th>
                                        <div id="tabla-cheques">
                                            <span title-button><br>Total </span>
                                        </div>
                                      </th>

                                    </tr>
                                    
                                  </thead>
                                  <tbody>
                                      <tr class="tr_solicitados_monto_nacional" id="">

                                          <td> Solicitado</td>
                                          <td>
                                            <input type="text" placeholder="$" readonly="readonly" class="form-control" value="{{ $cheques_nacional }}">
                                          </td>

                                          <td>
                                            <input type="text" placeholder="$" readonly="readonly" class="form-control" value="{{ $debito_nacional }}">
                                          </td>

                                          <td>
                                            <input type="text" placeholder="$" readonly="readonly" class="form-control" value="{{ $credito_nacional }}">
                                          </td>

                                          <td>
                                            <input type="text" placeholder="$" readonly="readonly" class="form-control" value="{{ $efectivo_nacional }}">
                                          </td>

                                          <td>
                                            <input type="text" placeholder="$" readonly="readonly" class="form-control" value="{{ $corporativa_nacional }}">
                                          </td>
                                          <td>{{ $total_nacional }} </td>
                                      </tr>
                                    <tr class="tr_solicitados_monto_nacional ">
                                        <td> Autorizado</td>
                                        <td>
                                          <input type="text" placeholder="$"  id="tr_autorizado_monto_nacional_1" class="form-control" value="{{ str_replace(['$',','],'',$cheques_nacional) }}" onblur="suma_montos()">
                                        </td>
                                        <td>
                                          <input type="text" placeholder="$"  id="tr_autorizado_monto_nacional_2" class="form-control" value="{{ str_replace(['$',','],'',$debito_nacional) }}" onblur="suma_montos()">
                                        </td>
                                        <td>
                                          <input type="text" placeholder="$"  id="tr_autorizado_monto_nacional_3" class="form-control" value="{{ str_replace(['$',','],'',$credito_nacional) }}" onblur="suma_montos()">
                                        </td>
                                        <td>
                                          <input type="text" placeholder="$"  id="tr_autorizado_monto_nacional_4" class="form-control" value="{{ str_replace(['$',','],'',$efectivo_nacional) }}" onblur="suma_montos()">
                                        </td>
                                        <td>
                                          <input type="text" placeholder="$"  id="tr_autorizado_monto_nacional_5" class="form-control" value="{{ str_replace(['$',','],'',$corporativa_nacional) }}" onblur="suma_montos()">
                                        </td>
                                        <td> $<strong id="total_nacional"></strong> </td>
                                    </tr>
                                    <tr> <td colspan="7"><hr></td> </tr>
                                    </tbody>
                            </table>


                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table-responsive table" id="tabla_extranjero">
                                  <thead>
                                    <tr rowspan="2"><div id="extranjero"> Extranjero </div></tr>
                                    <tr>
                                      <th>
                                        <div id="tabla-cheques">
                                            <span title-button><br>Monto </span>
                                        </div>
                                      </th>
                                      <th>
                                        <div id="tabla-cheques">
                                            <span class="icon-cheques"></span>
                                            <span title-button><br>Cheques </span>
                                        </div>
                                      </th>
                                      <th>
                                        <div id="tabla-cheques">
                                            <span class="icon-cheques"></span>
                                            <span title-button><br>Débito </span>
                                        </div>
                                      </th>
                                      <th>
                                        <div id="tabla-cheques">
                                            <span class="icon-cheques"></span>
                                            <span title-button><br>Crédito </span>
                                        </div>
                                      </th>
                                      <th>
                                        <div id="tabla-credito">
                                              <span class="icon-efectivo" ><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span><span class="path11"></span><span class="path12"></span></span>
                                              <span title-button><br>
                                              Efectivo
                                              </span>
                                          </div>
                                      </th>

                                      <th>
                                        <div id="tabla-cheques">
                                            <span class="icon-cheques"></span>
                                            <span title-button><br>Corporativa </span>
                                        </div>
                                      </th>

                                      <th>
                                        <div id="tabla-cheques">
                                            <span title-button><br>Total </span>
                                        </div>
                                      </th>

                                    </tr>

                                  </thead>
                                  <tbody>
                                      <tr class="tr_solicitados_monto_extranjero">
                                          <td> Solicitado</td>

                                          <td>
                                            <input type="text" placeholder="$" readonly="readonly" class="form-control" value="{{ $cheques_extranjero }}"">
                                          </td>

                                          <td>
                                            <input type="text" placeholder="$" readonly="readonly" class="form-control" value="{{ $debito_extranjero }}">
                                          </td>

                                          <td>
                                            <input type="text" placeholder="$" readonly="readonly" class="form-control" value="{{ $credito_extranjero }}">
                                          </td>

                                          <td>
                                            <input type="text" placeholder="$" readonly="readonly" class="form-control" value="{{ $efectivo_extranjero }}">
                                          </td>

                                          <td>
                                            <input type="text" placeholder="$" readonly="readonly" class="form-control" value="{{ $corporativa_extranjero }}">
                                          </td>

                                          <td> {{ $total_extranjero }}</td>
                                          </tr>

                                        <tr class="tr_solicitados_monto_extranjero">
                                            <td> Autorizado</td>
                                            <td>
                                              <input type="text" placeholder="$" id="tr_autorizado_monto_extranjero_1" class="form-control" value="{{ str_replace(['$',','],'',$cheques_extranjero) }}" onblur="suma_montos()">
                                            </td>
                                            <td>
                                              <input type="text" placeholder="$" id="tr_autorizado_monto_extranjero_2" class="form-control" value="{{ str_replace(['$',','],'',$debito_extranjero) }}" onblur="suma_montos()">
                                            </td>
                                            <td>
                                              <input type="text" placeholder="$" id="tr_autorizado_monto_extranjero_3" class="form-control" value="{{ str_replace(['$',','],'',$credito_extranjero) }}" onblur="suma_montos()">
                                            </td>
                                            <td>
                                              <input type="text" placeholder="$" id="tr_autorizado_monto_extranjero_4" class="form-control" value="{{ str_replace(['$',','],'',$efectivo_extranjero) }}" onblur="suma_montos()">
                                            </td>
                                            <td>
                                              <input type="text" placeholder="$" id="tr_autorizado_monto_extranjero_5" class="form-control" value="{{ str_replace(['$',','],'',$corporativa_extranjero) }}" onblur="suma_montos()">
                                            </td>
                                            <td> $<strong id="total_extranjero"></strong> </td>
                                        </tr>
                                    </tbody>
                              </table>

                            </div>


                                <div class="row" id="send_solicitud">
                            <input type="hidden" name="request_id" id="request_id">
                            <div class="col-md-12 col-xs-12">
                                <div class="row"> 
                                    <div class="col-sm-12">
                                        <div class="col-sm-4 center">
                                             <div id="total" class="total_solicitud"><span class="total_importe">
                                                  {{ format_currency($solicitudes['total']) }}</span>
                                             </div>
                                                <input type="hidden" name="total_solicitud_txt" id="total_solicitud_txt" class="total_solicitud_txt">
                                                <br>
                                                TOTAL
                                        </div>

                                        <div class="col-sm-4 center">
                                            <div class="col-sm-12">

                                                <div class="col-sm-6">
                                                    <button type="button" class="btn btn-primary" estatus="1" onclick="autorizaciones(this)">Autorizar</button>
                                                </div>
                                                <div class="col-sm-6" >
                                                    <button type="button" class="btn btn-danger" onclick="autorizaciones(this)" estatus="0" >Rechazar</button>
                                                </div>

                                            </div>
                                        </div>
                                        <!-- <div class="col-sm-4 center">
                                                <div id="autorizacion">
                                                    <span class="icon-acompanantes" style="font-size: 60px;">

                                                    </span>
                                                </div>
                                                <input type="hidden" name="user_id_autorization" id="user_id_autorization" value="af125f96-6750-44c2-bdde-67b9d23b131e" class="user_id_autorization">
                                                <br>
                                                Pendiente por Autorizar {{ $autorizador }}
                                        </div> -->
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


        </div>

<script type="text/javascript" src="{{asset('js/validate_autorizacion/validate_autorizacion.js')}}"></script>


@endsection

