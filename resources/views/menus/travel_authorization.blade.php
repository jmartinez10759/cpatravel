<!--Controller es RoutingController@viaje_Authorizacion-->
@extends('template.dashboard-container')
@section('content')
<div class="col-sm-12" id="section_conteiner">
	<input type="hidden" id="return" value="{{ $return }}">
    <button type="button" class="botonItemMenu button" onclick="carga_vista_html('solicitud/pendientes','authorization')"> {{ $button1 }}</button>
    <button type="button" class="botonItemMenu button">{{ $button2 }}</button>
</div>
@endsection