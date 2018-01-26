@extends('template.dashboard')
@section('content') <!-- BussinesController -->
    <div class="container">
        <div class="row">
            <div class="col-sm-offset-0 col-sm-12 table-responsive">
                <br>
                <center><h3>Listado de Empresas </h3></center>
                <br>
               {!!$tabla_empresas!!}
            </div>
        </div>
    </div>
<!--Se carga el script necesario de la lista de empresas-->
<script type="text/javascript" src="{{asset('js/business/list_business.js')}}"></script>

@endsection

