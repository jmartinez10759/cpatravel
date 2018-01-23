@extends('template.dashboard-container')
@section('content')
<div class="container-fluid">
    <br><br><br><br><br><br><br><br>
    <div class="row titulo-pantalla">
        <div class="col-sm-12">
            <div class="about-item scrollpoint sp-effect2">
                    <!-- <img src="{{ asset('images/menu/proceso_negocio.png') }}" alt="proceso_negocio"> -->
                    {{ $titulo_principal }}
            </div> 
        </div>
    </div>

    <br>

    <div class="row">
    	{!! $bloque_vista !!}
    </div> 
</div>

@endsection