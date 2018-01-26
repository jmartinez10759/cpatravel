@extends('template.dashboard-container')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('css/process_bussines/process-bussines.css') }}">
<br><br>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 ">
                <h3 class="titulo"> <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i> {{ $titulo_principal }}</h3>
            </div>
        </div>
        <br><br>
        <div class="row">
        	<div class="row col-sm-6">
        		
        		<div class="col-sm-12">
        			<!--seccion de los datos del usuario-->
                    <div class="col-sm-12">
                        <div class="col-sm-5">
                            <div class="conten-img">
                                <img alt="User Pic" src="{{ $avatar }}" class="img-circle img-responsive img-profile">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="conten-img-title">
                                USUARIO: {{ $usuario }}
                            </div>
                        </div>
                    </div>
		        	<!--end datos usuarios-->
		        	<!--inicio del buscador y sus datos de los proyectos, subproyectos y viajes-->
		        	<div class="col-sm-10">
                        <div class="input-group" id="adv-search">
                            <input type="text" class="form-control" placeholder="Buscar viaje" id="search_travel" />
                            <div class="input-group-btn">
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn">
                                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-2">
                        <span class="icon-mas" style="font-size: 30px; cursor: pointer;" onclick="add_new_project(this)">
                                <span class="path1"></span><span class="path2"></span>
                        </span>
                    </div> -->
                    <!--end buscador-->
                    <!--contenido de los proyectos-->
                    <div class="col-sm-12">
	                    <div class="panel-body pre-scrollable" id="list_project">
                            <ul class="tree">
                            @foreach($data as $datos)
                                <li>
                                    <input type="checkbox" id="p-{{ $datos['id_proyecto'] }}" project="project"/>
                                    <label data-type="1" 
                                            class="tree_label" 
                                            id_proyecto="{{ $datos['id_proyecto'] }}"
                                            onclick="select_proyect(this);" 
                                            for="p-{{ $datos['id_proyecto'] }}" 
                                            style="cursor: pointer;">
                                        <i class="fa fa-suitcase" aria-hidden="true"></i>
                                        {{ $datos['nombre'] }}
                                    </label>
                                    <ul>
                                        @foreach( $datos['subproyecto'] as $datos_sub)
                                        <li>
                                            <input type="checkbox" id="s-{{$datos_sub->id_subproyecto}}" subproject="subproject"/>
                                            <label  data-type="2"  
                                                    id_subproyecto="{{ $datos_sub->id_subproyecto }}" 
                                                    class="tree_label" 
                                                    onclick="select_subproyect(this)"
                                                    for="s-{{$datos_sub->id_subproyecto}}"
                                                    >
                                                <i class="fa fa-folder-open" aria-hidden="true"></i> {{ $datos_sub->nombre }}
                                            </label>
                                            <ul>
                                                @foreach($datos_sub->viajes as $datos_viajes)
                                                <li>
                                                    <i class="fa fa-plane" style="color: #2C398E;" aria-hidden="true"></i>
                                                    <span class="tree_label" id_viaje="{{ $datos_viajes->id_viaje }}" style="cursor: pointer;" onclick="select_viaje(this);">{{ $datos_viajes->nombre }}</span>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                                @endforeach
                            </ul>
	                    </div>
                    </div>
                   <!--end buscador y proyectos -->

        		</div>

        	</div>

            <input type="hidden" id="id_proyecto">
            <input type="hidden" id="id_subproyecto">
            <input type="hidden" id="id_viaje">

        	<div class="row col-sm-6">

                         <div id="div_proyecto">
                                <div class="panel panel-default" style="background: transparent; border-color: #099C7F;">
                                    <div class="panel-heading"  style="background: transparent;border-color: transparent;">
                                        <h3 class="panel-title"> <i class="fa icon-proyectos fa-form-title" aria-hidden="true"></i>  Proyectos </h3>
                                    </div>
                                    <div class="panel-body">
                                        <form class="form-horizontal">
                                            <div class='form-group'>
                                                <label class='control-label label-form col-md-2'>Nombre:</label>
                                                <div class="col-md-10">
                                                   <input type="text" class="form-control" id="nombre">
                                                </div>
                                            </div>
                                            <div class='form-group'>
                                                <label class='control-label label-form col-md-2'>Descripcion</label>
                                                <div class="col-md-10">
                                                    <textarea class="form-control" id="proyecto"> </textarea>
                                                </div>
                                            </div>
                                            <div class='form-group'>
                                                <label class='control-label label-form col-md-2'>Referencia</label>
                                                <div class="col-md-10">
                                                    <input type="checkbox" id="">
                                                </div>
                                            </div>
                                            <div class='form-group'>
                                                <label class='control-label label-form col-md-2'>Estatus</label>
                                                <div class="col-md-10">
                                                    <select class="form-control" id="status">
                                                        <option value="0">Inactivo</option>
                                                        <option value="1">Activo</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class='form-group'>
                                                <div class="col-md-12">
                                                    <button type="button" class="btn btn-save pull-right save_register" form="form-proyectos" onclick="save_register(this)">Registrar</button>
                                                    <button type="button" class="btn btn-primary pull-right actualizar" form="form-proyectos" onclick="actualizar(this)" style="display: none;">Actualizar</button>
                                                </div>
                                            </div>
                                    </form>
                                        <div class="form-group pull-right content-plus" id="add-show" style="display: none;">
                                            <span class="icon-mas">
                                                    <span class="path1"></span><span class="path2" data-toggle="tooltip" title="Agregar Proyecto" onclick="add_proyectos()"></span>
                                            </span>
                                                <i class="icon-subproyectos_verde" onclick="add_subproyectos()" data-toggle="tooltip" title="Agregar Sub Proyecto"> </i>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        


                            <div style="display: none;" id="div_subproyecto">
                                     <div class="panel panel-default" style="background: transparent; border-color: #099C7F;">
                                    <div class="panel-heading"  style="background: transparent;border-color: transparent;">
                                        <h3 class="panel-title"> <i class="fa icon-subproyectos fa-form-title" aria-hidden="true"></i> Sub Proyectos </h3>
                                    </div>
                                    <div class="panel-body">
                                       <form class="form-horizontal">
                                            <div class='form-group'>
                                                <label class='control-label label-form col-md-2'>Proyecto: </label>
                                                <div class="col-md-10">
                                                    <label class='control-label label-name-project label-form nombre_proyecto'></label>
                                                </div>
                                            </div>
                                            <div class='form-group'>
                                                <label class='control-label label-form col-md-2'>Nombre:</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" id="sub_nombre">
                                                </div>
                                            </div>
                                            <div class='form-group'>
                                                <label class='control-label label-form col-md-2'>Descripcion</label>
                                                <div class="col-md-10">
                                                    <textarea class="form-control" id="sub_proyecto"> </textarea>
                                                </div>
                                            </div>

                                            <div class='form-group'>
                                                <label class='control-label label-form col-md-2'>Referencia</label>
                                                <div class="col-md-10">
                                                    <input type="checkbox" id="">
                                                </div>
                                            </div>

                                            <div class='form-group'>
                                                <label class='control-label label-form col-md-2'>Estatus</label>
                                                <div class="col-md-10">
                                                    <select class="form-control" id="sub_status">
                                                        <option value="0">Inactivo</option>
                                                        <option value="1">Activo</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class='form-group'>
                                                <div class="col-md-12">
                                                    <button type="button" class="btn btn-save pull-right save_register" form="form-subproyectos" onclick="save_register(this)">Registrar</button>
                                                    <button type="button" class="btn btn-primary pull-right actualizar" form="form-subproyectos" onclick="actualizar(this)" style="display: none;">Actualizar</button>
                                                </div>
                                            </div>

                                        </form>
                                        <div class="form-group pull-right content-plus" id="add-show-viaje" style="display: none;">
                                            <span class="icon-mas">
                                                <span class="path1"></span><span class="path2" onclick="add_subproyectos()" data-toggle="tooltip" title="Agregar Sub Proyecto"></span>
                                            </span>
                                            <i class="icon-viaje_verde" data-toggle="tooltip" title="Agregar Viaje" onclick="add_viajes()" d> </i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div style="display: none;" id="div_viajes">
                                    <div class="panel panel-default" style="background: transparent; border-color: #099C7F;">
                                    <div class="panel-heading"  style="background: transparent;border-color: transparent;">
                                        <h3 class="panel-title"> <i class="fa icon-viaje fa-form-title" aria-hidden="true"></i> Viajes </h3>
                                    </div>
                                    <div class="panel-body">
                                    <form class="form-horizontal">
                                            <div class='form-group'>
                                                <label class='control-label label-form col-md-3'>Proyecto</label>
                                                <div class="col-md-9">
                                                    <label class='control-label label-name-project label-form nombre_proyecto' ></label>
                                                </div>
                                            </div>
                                            <div class='form-group'>
                                                <label class='control-label label-form col-md-3'>Sub Proyecto</label>
                                                <div class="col-md-9">
                                                    <label class='control-label label-name-subproject label-form nombre_sub_proyecto'></label>
                                                </div>
                                            </div>
                                            <div class='form-group'>
                                                <label class='control-label label-form col-md-3'>Nombre del Viaje</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" id="viaje_nombre">
                                                </div>
                                            </div>

                                            <div class='form-group'>
                                                <label class='control-label label-form col-md-3'>Descripcion</label>
                                                <div class="col-md-9">
                                                    <textarea class="form-control" id="viaje"></textarea>
                                                </div>
                                            </div>
                                            <div class='form-group'>
                                                <label class='control-label label-form col-md-2'>Referencia</label>
                                                <div class="col-md-10">
                                                    <input type="checkbox" id="">
                                                </div>
                                            </div>
                                            <div class='form-group'>
                                                <label class='control-label label-form col-md-3'>Estatus</label>
                                                <div class="col-md-9">
                                                    <select class="form-control" id="viaje_status">
                                                        <option value="0">Inactivo</option>
                                                        <option value="1">Activo</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- <div class='form-group'>
                                                <label class='control-label label-form col-md-3'>Nombre corto</label>
                                                <div class="col-md-9">
                                                    {{ Form::text('nombre_corto','',['class' => 'form-control','id'=>'txt_travel_short_name']) }}
                                                </div>
                                            </div> -->
                                            <!-- <div class='form-group info_user_travel hidden'>
                                                <label class='control-label label-user-travel label-form col-xs-6'>Autor: {{ "Ricardo Lugo" }}</label>
                                                <div class="col-xs-6">
                                                    <label class='control-label label-form fecha-travel'> Fecha : </label>
                                                </div>
                                            </div> -->
                                            <div class='form-group'>
                                                <div class="col-md-12">
                                                    <button type="button" class="btn btn-save pull-right save_register" form="form-viajes" onclick="save_register(this)">Registrar</button>
                                                    <button type="button" class="btn btn-primary pull-right actualizar" form="form-viajes" onclick="actualizar(this)" style="display: none;">Actualizar</button>
                                                </div>
                                            </div>
                                    </form>
                                    <div class="form-group pull-right content-plus" id="add-show-viaje" style="display: block;">
                                        <span class="icon-mas">
                                            <span class="path1"></span><span class="path2" onclick="add_viajes()" data-toggle="tooltip" title="Agregar Sub Proyecto"></span>
                                        </span>
                                    </div>



                                </div>
                            </div>



                            </div>


                    </div>

        	</div>

        </div>
    </div>

<br><br><br>

<input type="hidden" id="return" value="{{ $return }}">

@endsection