@extends('template.dashboard')
@section('content') <!-- BussinesController -->
    <div class="container">
      <input type="hidden" id="path_url" value="{{ route('busine_select') }}">
      <input type="hidden" id="path_index" value="{{ route('auth.index') }}">
        <div class="row">
            <div class="col-sm-offset-0 col-sm-12 table-responsive">
                <br>
                <center><h3>Listado de Empresas </h3></center>
                <br>
               <!-- <table class="table table-striped table-condensed table-hover ">
                 <thead>
                   <tr>
                       <th>#</th>
                       <th>ID Grupo</th>
                       <th>Nombre Grupo</th>
                       <th>RFC</th>
                       <th>Razon Social</th>
                   </tr>
                 </thead>
                 <tbody>
                  <?php $i = 1; ?>
                 @foreach($lista->rows as $list)
                   <tr>
                       <td>{{$i++}}</td>
                       <td>{{ $list->id_grupo }}</td>
                       <td>
                          <a href="#" data-id= "{{ $list->empresa }}" data-group="{{ $list->id_grupo }}" data-description="{{ $list->nombreGrupo}}" onclick="business(this)">{{ $list->nombreGrupo }}</a>
                       </td>
                       <td>{{ $list->rfc }}</td>
                       <td>{{ $list->razonSocial }}</td>
                   </tr>
                  @endforeach
                 </tbody>
               </table> -->
               {!!$tabla_empresas!!}

            </div>
        </div>
    </div>
<!--Se carga el script necesario de la lista de empresas-->
<script type="text/javascript" src="{{asset('js/business/list_business.js')}}"></script>

@endsection

