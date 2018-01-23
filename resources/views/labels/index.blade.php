@extends('layouts.app')

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
			<span class="icon-icon_etiquetas icon-tam2"></span>
                ETIQUETAS
            </div><! --/about-item -->
        </div><! --/col-md-3 -->
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-6">
            <div class="col-md-2">
                <div class="conten-img-2">
                    <img alt="User Pic" src="{{ Session::get('img') }}" class="img-circle img-responsive img-profile">
                </div>
            </div>
            <div class="col-md-8">
                <div class="conten-img-title-2">
                    Usuario: {{ Session::get('name').'  '.Session::get('lastName') }}
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 2%">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="col-md-5">
                <div class="row ">
                    <div class="title-row">
                        <span class="icon-icon_prederminadoagregar icon-tam"></span>
                        Predeterminadas
                        <span class="icon-mas icon-tam">
                            <span class="path1"></span><span class="path2"></span>
                        </span>
                    </div>
                </div>
                <div class="row">
                    <table class="table">
                        <div class="col-md-12 col-xs-12 nombre-etiquetas2">
                	
                	Nombre
					
					</div>
                        <tbody>
                            @foreach($dataLabel as $dat)
                                <tr>
                                    @if($dat->name == 'Alimentación')
                                        <td class="icon-30">
                                            <span class="icon-comida" data-id="{{ $dat->iden }}" >
                                                <span class="path1"></span><span class="path2"></span>
                                            </span>
                                        </td>
                                    @elseif($dat->name == 'Transporte')
                                        <td class="icon-30">
                                           <span class="icon-transporte_publico" data-id="{{ $dat->iden }}"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span></span>
                                            
                                        </td>
                                    @elseif($dat->name == 'Hospedaje')
                                        <td class="icon-30">
                                            <span class="icon-hospedaje">
                                                <span class="path1"></span><span class="path2"></span>
                                            </span>
                                        </td>
                                    @elseif($dat->name == 'Renta de Autos')
                                        <td class="icon-30">
                                            <span class="icon-renta_autos">
                                                <span class="path1"></span><span class="path2"></span>
                                            </span>
                                        </td>
                                    @elseif($dat->name == 'Seminarios o Convenciones')
                                        <td class="icon-30">
                                            <span class="icon-seminarios">
                                                <span class="path1"></span><span class="path2"></span>
                                            </span>
                                        </td>
                                    @elseif($dat->name == 'Pago por kilometraje')
                                        <td class="icon-30">
                                            <span class="icon-kilometraje">
                                                <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span>
                                            </span>
                                        </td>
                                    @elseif($dat->name == 'Renta de Transporte aéreo')
                                        <td class="icon-30">
                                            <span class="icon-transporte_aereo">
                                                <span class="path1"></span><span class="path2"></span>
                                            </span>
                                        </td>
                                    @elseif($dat->name == 'Renta de Transporte terrestre')
                                        <td class="icon-30">
                                            <span class="icon-transporte_terrestre ">
                                                <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span><span class="path11"></span>
                                            </span>
                                        </td>
                                    @endif
                                    <td class="text-tr">
                                            {{ $dat->name }}
                                    </td>
                                    <td class="click_href" data-href="{{ route('label.show',['label' => $dat->iden]) }}">
                                        <span class="icon-icon_nota" data-type="1" data-id="{{ $dat->iden }}" style="cursor: pointer; font-size: 20px;" ></span>
                                    </td>
                                    <td>
                                        <span class="icon-icon_cancelar click_label" data-type="1" data-id="{{ $dat->iden }}" style="cursor: pointer; font-size: 20px;">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-1 col-xs-1"></div>
            <div class="col-md-6 col-xs-12">
              <div class="row ">
                    <div class="title-row col-md-12 col-xs-12">
                        <span class="icon-icon_corporativas icon-tam"></span>
                        Corporativas
                        <span class="icon-mas icon-tam">
                            <span class="path1"></span><span class="path2"></span>
                        </span>
                    </div>
                </div>
              		<div class="row">
                	<div class="col-md-5 col-xs-5 nombre-etiquetas">
                	
                	Nombre
					
					</div>
					<div class="col-md-7  col-xs-7 viaje-etiquetas">
                	
                	Viaje
					
					</div>
					
					
				</div>
				<div class="row text-tr">
					<table width="100%" class="table" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                            @foreach($dataLabelCorporativas as $labelC)
                                <tr>
                                    <td>{{ $labelC->name }}</td>

                                    <td class="click_href" data-href="{{ route('label.show',['label' => $labelC->iden]) }}">
                                        <span class="icon-icon_nota" data-type="1" data-id="{{ $labelC->iden }}" style="cursor: pointer; font-size: 20px;" ></span>
                                    </td>
                                    <td>
                                      <span class="icon-icon_cancelar click_label" data-type="1" data-id="{{ $labelC->iden }}" style="cursor: pointer; font-size: 20px;">
                                          <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                                      </span>
                                    </td>
                                </tr>
                            @endforeach
                          </tbody>
                    </table>
	            </div>
				 <div class="row ">
                    <div class="title-row col-md-12 col-xs-12">
                       <span class="icon-icon_dispositivousuario icon-tam"></span>
                        Usuario
                        <span class="icon-mas icon-tam">
                            <span class="path1"></span><span class="path2"></span>
                        </span>

                    </div>
                </div>
              		<div class="row">
                	<div class="col-md-5 col-xs-5 nombre-etiquetas">
                	
                	Nombre
					
					</div>
					<div class="col-md-7  col-xs-7 viaje-etiquetas">
                	
                	Viaje
					
					</div>
					
				</div>
				<div class="row">
					<table width="100%" class="table" border="0" cellspacing="0" cellpadding="0">
                      <tbody>
                          @foreach($dataLabelPersonalizadas as $labelP)
                              <tr>
                                  <td class="text-tr">{{ $labelP->name }}</td>
                                  <td class="text-tr">{{ $labelP->travel->name }}</td>
                                  <td class="click_href" data-href="{{ route('label.show',['label' => $labelP->iden]) }}">
                                      <span class="icon-icon_nota" data-type="1" data-id="{{ $labelP->iden }}" style="cursor: pointer; font-size: 20px;" ></span>
                                  </td>
                                  <td>
                                      <span class="icon-icon_cancelar click_label" data-type="1" data-id="{{ $labelP->iden }}" style="cursor: pointer; font-size: 20px;">
                                          <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                                      </span>
                                  </td>
                              </tr>
                          @endforeach
                      </tbody>
                    </table>
	            </div>
		</div>
        </div>
    </div>

    <script>
        $(document).ready(function(){

        });
    </script>



@endsection