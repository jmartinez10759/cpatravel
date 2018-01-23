@extends('template.dashboard-container')
@section('content')
    <!--<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
    {{--<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">--}}-->
    <br><br>
    <div class="container profile">
        <div class="row">
            <div class="span12">
                {{--{{ $home->pru() }}--}}
                    <div class=" well-small clearfix">
                    <div class="row-fluid">
                        <div class="span2">
                            <img src="http://www.gravatar.com/avatar/f6112e781842d6a2b4636b35451401ff?s=125" style="border-radius: 50%;" class="img-polaroid" />
                        </div>
                        <div class="span4">
                            <h3 class="title_name"> {{ Auth::user()->name }}</h3>
                        </div>
                        <div class="span6 ">

                            <div><!--/span6-->
                            </div><!--/row-->
                        </div>
                        <!--Body content-->
                    </div>
                </div>

                <!-- Inicia apartado de proyectos -->
                    <div class=" well-small clearfix">
                            <div class="span2">
                                <label class="label_icon glyphicon glyphicon-lock" for="Proyectos"> Proyectos </label>
                            </div>
                    </div>

                    <div class=" clearfix">
                        
                    <table class="table  table-sm">
                        <thead class="table-info">
                        <tr>

                            <th>Proyecto</th>
                            <th>Descripción</th>
                            <th>Responsable</th>
                            <th>Estatus</th>
                        </tr>
                        </thead>
                        <tbody >
                            @foreach($projects as $pj)
                                <tr>
                                    {{ Form::open(['id' =>'form-project-'.$pj->id ])  }}
                                        <td>
                                            <div class="form-group">
                                                <input type="text" name="id" class="hidden" value="{{ $pj->id  }}">
                                                {{ Form::text('name', $pj->name ,['class' =>'form-control hidden '.''. 'data-txt-project-'.$pj->id]) }}
                                                <label for="" class="label-txt-project-{{$pj->id }}"> {{ $pj->name }} </label>
                                            </div>
                                        </td>
                                        <td>
                                            {{ Form::text('description', $pj->description ,['class' =>'form-control hidden '.''. 'data-txt-project-'.$pj->id]) }}
                                            <label for="" class="label-txt-project-{{$pj->id }}"> {{ $pj->description }} </label>
                                        </td>
                                        <td>
                                            {{ Form::text('user', $pj->user->name ,['class' =>'typeahead form-control hidden '.''. 'data-txt-project-'.$pj->id,'data-txt-hidden' => 'data-txt-h-project-'.$pj->id]) }}
                                            <input type="text" value="{{ $pj->user->id }} " name="user_id" id="data-txt-h-project-{{$pj->id}}" class="hidden form-control">
                                            <label for="" class="label-txt-project-{{$pj->id }}"> {{ $pj->user->name }} </label></td>
                                        <td>

                                            {{ Form::select('active', array('1' => 'Activo', '0' => 'Inativo'), $pj->active  ,['class' =>'form-control hidden '.''. 'data-txt-project-'.$pj->id])  }}
                                            <label for="" class="label-txt-project-{{$pj->id }}">{{ ($pj->active)? 'Activo': 'Inactivo' }} </label></td>
                                        <td>
                                            <span data-iden='0' class ='glyphicon-default glyphicon glyphicon-pencil edit-project' data-id="{{ $pj->id }}" data-name="project"></span>
                                            <span class ='glyphicon-warning glyphicon glyphicon-remove project-r-{{ $pj->id }}'></span>
                                        </td>
                                    {{ Form::close() }}
                                </tr>
                            @endforeach
                            <tr class="hidden" id="table-projects">
                                {{ Form::open(['id' =>'form-project-default' ])  }}
                                    <td>
                                        <div class="form-group">
                                            {{ Form::text('name', '' ,['class' =>'form-control']) }}
                                            {{ Form::text('id', '' ,['class' =>' hidden form-control']) }}
                                        </div>
                                    </td>
                                    <td>
                                        {{ Form::text('description', '' ,['class' =>'form-control']) }}
                                    </td>
                                    <td>
                                        {{ Form::text('user', '' ,['class' =>'typeahead form-control','data-txt-hidden' => 'data-txt-h-project-default']) }}
                                        <input type="text" value="" name="user_id" id="data-txt-h-project-default" class="hidden form-control" >
                                    </td>
                                    <td>
                                        {{ Form::select('active', array('1' => 'Activo', '0' => 'Inativo'), 1 ,['class' =>'form-control'])  }}
                                    </td>
                                    <td>
                                        <span data-iden='1' class ='glyphicon-success glyphicon glyphicon-floppy-disk edit-project' data-id="default" data-name="project"></span>
                                        <span class ='glyphicon-warning glyphicon glyphicon-remove'></span>
                                    </td>
                                {{ Form::close() }}
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <span data-iden='0' class ='glyphicon-success glyphicon glyphicon-plus-sign add-row' data-name="projects">Agregar</span>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- Termina  apartado de sub proyectos -->

                <!-- Inicia apartado de sub proyectos -->
                    <div class=" well-small clearfix">
                        <div class="span6">
                            <label class="label_icon glyphicon glyphicon-folder-close" for="Proyectos"> SubProyectos </label>
                        </div>
                    </div>

                    <div class=" clearfix">
                        <table class="table  table-sm">
                            <thead class="table-info">
                            <tr>

                                <th>Proyecto</th>
                                <th>Sub Proyecto</th>
                                <th>Descripción</th>
                                <th>Responsable</th>
                                <th>Estatus</th>
                            </tr>
                            </thead>
                            <tbody >
                            @foreach($subproject as $spj)
                                <tr>
                                    {{ Form::open(['id' =>'form-sub-project-'.$spj->id ])  }}
                                    <td>
                                        {{ Form::text('proyecto', $spj->project->name  ,['class' =>'form-control hidden '.''. 'data-txt-sub-project-'.$spj->id]) }}
                                        <label for="" class="label-txt-sub-project-{{$spj->id }}"> {{ $spj->project->name  }} </label>
                                    </td>
                                    <td>
                                        {{ Form::text('Sub_proyecto', $spj->name ,['class' =>'form-control hidden '.''. 'data-txt-sub-project-'.$spj->id]) }}
                                        <label for="" class="label-txt-sub-project-{{$spj->id }}"> {{ $spj->name }} </label>
                                    </td>
                                    <td>
                                        {{ Form::text('description', $spj->description ,['class' =>'form-control hidden '.''. 'data-txt-sub-project-'.$spj->id]) }}
                                        <label for="" class="label-txt-sub-project-{{$spj->id }}"> {{ $spj->description }} </label>
                                    </td>
                                    <td>
                                        {{ Form::text('user_id', $spj->user->name ,['class' =>'typeahead form-control hidden '.''. 'data-txt-sub-project-'.$spj->id,'data-txt-hidden' => 'data-txt-h-sub-project-'.$spj->id]) }}
                                        <input type="text" value ="{{ $spj->user->id }}" name="user_id" id="data-txt-h-sub-project-{{$spj->id}}" class="hidden form-control" >
                                        <label for="" class="label-txt-sub-project-{{$spj->id }}"> {{ $spj->user->name }} </label>

                                        </td>
                                    <td>

                                        {{ Form::select('active', array('1' => 'Activo', '0' => 'Inativo'), $spj->active  ,['class' =>'form-control hidden '.''. 'data-txt-sub-project-'.$spj->id])  }}
                                        <label for="" class="label-txt-sub-project-{{$spj->id }}">{{ ($spj->active)? 'Activo': 'Inactivo' }} </label>

                                    <td>
                                        <span data-iden='0' class ='glyphicon-default glyphicon glyphicon-pencil edit-project' data-id="{{ $spj->id }}" data-name="sub-project"></span>
                                        <span class ='glyphicon-warning glyphicon glyphicon-remove project-r-{{ $pj->id }}'></span>
                                    </td>
                                    {{ Form::close()  }}
                                </tr>
                            @endforeach
                            <tr id="table-sub-projects" class="hidden">
                                {{ Form::open(['id' =>'form-sub-project-'.$spj->id ])  }}
                                <td>
                                    {{ Form::text('proyecto', ''  ,['class' =>'form-control']) }}
                                    {{ Form::text('id', '',['class' =>'form-control hidden']) }}
                                </td>
                                <td>
                                    {{ Form::text('sub_proyecto', '' ,['class' =>'form-control']) }}
                                </td>
                                <td>
                                    {{ Form::text('description','',['class' =>'form-control']) }}
                                </td>
                                <td>
                                    {{ Form::text('user_id', '',['class' =>'typeahead form-control','data-txt-hidden' => 'data-txt-h-sub-project-default']) }}
                                    <input type="text" value ="" name="user_id" id="data-txt-h-sub-project-default" class=" form-control hidden" >
                                </td>
                                <td>

                                    {{ Form::select('active', array('1' => 'Activo', '0' => 'Inativo'), 1 ,['class' =>'form-control'])  }}
                                <td>
                                    <span data-iden='0' class ='glyphicon-default glyphicon glyphicon-pencil edit-project' data-id="default" data-name="sub-project"></span>
                                    <span class ='glyphicon-warning glyphicon glyphicon-remove project-r-'></span>
                                </td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <span data-iden='0'  class ='glyphicon-success glyphicon glyphicon-plus-sign add-row' data-name="sub-projects">Agregar</span>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                <!-- Termina  apartado de sub proyectos -->

                <!-- Inicia apartado de Viajes -->
                    <div class=" well-small clearfix">
                        <div class="span6">
                            <label class="label_icon glyphicon glyphicon-plane" for="Proyectos"> Viaje </label>
                        </div>
                    </div>

                    <div class=" clearfix">
                        <table class="table  table-sm">
                            <thead class="table-info">
                            <tr>

                                <th>Cuenta Viajes</th>
                                <th>Proyecto</th>
                                <th>Sub Proyecto</th>
                                <th>Asignado a</th>
                                <th>Monto Maximo a Autorizar</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody id="table-travels">
                            @foreach($travel as $tr)
                                <tr>
                                    {{ Form::open(['id' =>'form-travel-'.$tr->id ])  }}
                                    <td>
                                        {{ Form::text('travel_account', $tr->travel_account  ,['class' =>'form-control hidden '.''. 'data-txt-travel-'.$tr->id]) }}
                                        <label for="" class="label-txt-travel-{{$tr->id }}"> {{ $tr->travel_account }} </label>

                                    </td>
                                    <td>
                                        {{ Form::text('proyecto', $tr->project->name  ,['class' =>'form-control hidden '.''. 'data-txt-travel-'.$tr->id]) }}
                                        <label for="" class="label-txt-travel-{{$tr->id }}"> {{ $tr->project->name  }} </label>
                                    </td>
                                    <td>
                                        {{ Form::text('Sub_proyecto', $tr->subproject->name ,['class' =>'form-control hidden '.''. 'data-txt-travel-'.$tr->id]) }}
                                        <label for="" class="label-txt-travel-{{$tr->id }}"> {{ $tr->subproject->name  }} </label>
                                    </td>
                                    <td>
                                        {{ Form::text('user_id', $tr->user->name ,['class' =>'typeahead form-control hidden '.''. 'data-txt-travel-'.$tr->id,'data-txt-hidden' => 'data-txt-h-travel-'.$tr->id]) }}
                                        <input type="text" value="{{ $tr->user->id }}" name="user_id" id="data-txt-h-travel-{{$tr->id}}" class="hidden form-control">
                                        <label for="" class="label-txt-travel-{{$tr->id }}"> {{ $tr->user->name }} </label>
                                    </td>
                                    <td>
                                        {{ Form::text('monto', $tr->amount ,['class' =>'form-control hidden '.''. 'data-txt-travel-'.$tr->id]) }}
                                        <label for="" class="label-txt-travel-{{$tr->id }}"> {{ $tr->amount }} </label>
                                    </td>
                                    <td>
                                        {{ Form::select('active', array('1' => 'Activo', '0' => 'Inativo'), $tr->active  ,['class' =>'form-control hidden '.''. 'data-txt-travel-'.$tr->id])  }}
                                        <label for="" class="label-txt-travel-{{$tr->id }}">{{ ($tr->active)? 'Activo': 'Inactivo' }}
                                    </td>
                                    <td>
                                        <span data-iden='0' class ='glyphicon-default glyphicon glyphicon-pencil edit-project' data-id="{{ $tr->id }}" data-name="travel"></span>
                                        <span class ='glyphicon-warning glyphicon glyphicon-remove project-r-{{ $tr->id }}'></span>
                                    </td>
                                    {{ Form::close()  }}
                                </tr>
                            @endforeach
                                <tr>
                                    {{ Form::open(['id' =>'form-travel-'.$tr->id ])  }}
                                    <td>
                                        {{ Form::text('travel_account', $tr->travel_account  ,['class' =>'form-control hidden '.''. 'data-txt-travel-'.$tr->id]) }}
                                        <label for="" class="label-txt-travel-{{$tr->id }}"> {{ $tr->travel_account }} </label>

                                    </td>
                                    <td>
                                        {{ Form::text('proyecto', $tr->project->name  ,['class' =>'form-control hidden '.''. 'data-txt-travel-'.$tr->id]) }}
                                        <label for="" class="label-txt-travel-{{$tr->id }}"> {{ $tr->project->name  }} </label>
                                    </td>
                                    <td>
                                        {{ Form::text('Sub_proyecto', $tr->subproject->name ,['class' =>'form-control hidden '.''. 'data-txt-travel-'.$tr->id]) }}
                                        <label for="" class="label-txt-travel-{{$tr->id }}"> {{ $tr->subproject->name  }} </label>
                                    </td>
                                    <td>
                                        {{ Form::text('user_id', $tr->user->name ,['class' =>'typeahead form-control hidden '.''. 'data-txt-travel-'.$tr->id,'data-txt-hidden' => 'data-txt-h-travel-'.$tr->id]) }}
                                        <input type="text" value="{{ $tr->user->id }}" name="user_id" id="data-txt-h-travel-{{$tr->id}}" class="hidden form-control">
                                        <label for="" class="label-txt-travel-{{$tr->id }}"> {{ $tr->user->name }} </label>
                                    </td>
                                    <td>
                                        {{ Form::text('monto', $tr->amount ,['class' =>'form-control']) }}
                                    </td>
                                    <td>
                                        {{ Form::select('active', array('1' => 'Activo', '0' => 'Inativo'), $tr->active  ,['class' =>'form-control'])  }}
                                    </td>
                                    <td>
                                        <span data-iden='0' class ='glyphicon-default glyphicon glyphicon-pencil edit-project' data-id="default" data-name="travel"></span>
                                        <span class ='glyphicon-warning glyphicon glyphicon-remove project-r-{{ $tr->id }}'></span>
                                    </td>
                                    {{ Form::close()  }}
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <span data-iden='0' class ='glyphicon-success glyphicon glyphicon-plus-sign add-row' data-name="travels">Agregar</span>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                <!-- Termina apartado de Viajes -->

            </div>
            <div id="script">
                <script>
                    $(document).ready(function(){
                        $(".typeahead").typeahead({
                            input: '.typeahead',
                            source: function (query, process) {

                                return $.get('{{ route('autocomplete') }}', { query: query }, function (data) {
                                    return process(data);
                                });
                            },
                            autoSelect: true,
                            updater: function(item) {
                                $attrEl = this.$element.attr("data-txt-hidden");
                                $('#'+$attrEl).val(item.id)



                               /* $(".typeahead > ul > input").val('hola');
                                console.log($(this).attr('data-txt-hidden'));*/
                                return item;
                            }

                        });

                        $('.edit-project').unbind().bind('click',function(){
                            $name= $(this).attr('data-name');
                            if($(this).attr('data-iden') == 0){
                                $(this).addClass('glyphicon-success');
                                $(this).removeClass('glyphicon-pencil');
                                $(this).addClass('glyphicon-floppy-disk');
                                $(this).removeClass('glyphicon-default');
                                $(this).attr('data-iden',1);
                                $('.data-txt-'+$name+'-'+$(this).attr('data-id')).removeClass('hidden');
                                $('.label-txt-'+$name+'-'+$(this).attr('data-id')).addClass('hidden');
                            }else{

                                $seri = $('#form-'+$name+'-'+$(this).attr('data-id')).serialize();
                                console.log('#form-'+$name+'-'+$(this).attr('data-id'));
                                console.log($seri);
                                $.ajax({
                                    url : '{{ route('project.create') }}',
                                    type:'GET',
                                    data: $('#form-'+$name+'-'+$(this).attr('data-id')).serialize(),
                                    dataType: 'json',
                                    success:function(msj){

                                    },error:function(data){

                                    }
                                });
                            }

                        });

                        $('.add-row').unbind().bind('click',function(){
                            $(this).attr('data-name');
                            $tableHtml= $('#table-'+$(this).attr('data-name')).html();
                            $('#table-'+$(this).attr('data-name')).removeClass('hidden');
                            console.log('#table-'+$(this).attr('data-name'));
                            $script=$('#script').html();
                            if($(this).attr('data-iden') == 0) {
                                /*$htmlNew = $tableHtml + EvatNameEvento($(this).attr('data-name')) + $script;
                                $(this).attr('data-iden',1);
                                alert('iffff');*/
                            }else{
                                $htmlNew = $tableHtml + EvatNameEvento($(this).attr('data-name'));
                                alert('else');
                            }
                            /*console.log(EvatNameEvento($(this).attr('data-name')));*/
                           /* $('#table-'+$(this).attr('data-name')).html($htmlNew);*/

                        });
                        function EvatNameEvento(nameEvent){

                            if(nameEvent == 'projects'){

                                return formProject();

                            }else if(nameEvent == 'sub-projects'){

                                return formSubproject();
                            }else{
                                return formTravel();
                            }
                        }

                        function formProject(){
                            $random = Math.floor((Math.random() * 100000) + 1);

                            /*return $html =
                                    '<form action="" method="POST" id="prueb-id>'+
                                    '{{ csrf_field() }}'+
                                    '<td>{{ Form::text('name', '' ,['class' =>'form-control ', 'data-txt-']) }}</td>'+
                                    '<td>{{ Form::text('description', '' ,['class' =>'form-control', 'data-txt-']) }}</td>'+
                                    '<td>{{ Form::text('user_id', '',['class' =>'typeahead form-control','data-txt-']) }}</td>'+
                                    '<td> {{ Form::select('active', array('1' => 'Activo', '0' => 'Inativo'),1,['class' =>'form-control '])  }}</td>'+
                                    '<td>' +
                                    '<span data-iden="1"  class ="glyphicon-success glyphicon glyphicon-floppy-disk edit-project" data-id="'+ $random+'" data-name="project"></span>'+
                                    '<span class ="glyphicon-warning glyphicon glyphicon-remove project-r-"></span></td>' +
                                    '</form>';*/
                        }


                        function formSubproject(){
                            return $html ='<tr><td>{{ Form::text('proyecto', '' ,['class' =>'form-control ', 'data-txt-']) }}</td>'+
                                    '<td>{{ Form::text('subproyecto', '' ,['class' =>'form-control', 'data-txt-']) }}</td>'+
                                    '<td>{{ Form::text('description', '',['class' =>'form-control','data-txt-']) }}</td>'+
                                    '<td>{{ Form::text('user_id', '',['class' =>'typeahead form-control','data-txt-']) }}</td>'+
                                    '<td> {{ Form::select('active', array('1' => 'Activo', '0' => 'Inativo'),1,['class' =>'form-control '])  }}</td>'+
                                    '<td><span data-iden="1" class ="glyphicon-success glyphicon glyphicon-floppy-disk edit-project" data-id=""></span><span class ="glyphicon-warning glyphicon glyphicon-remove project-r-"></span></td>'+
                                    '</tr>';

                        }

                        function formTravel(){
                            return $html ='<tr>' +
                                    '<td>{{ Form::text('cuenta viajes', '' ,['class' =>'form-control ', 'data-txt-']) }}</td>'+
                                    '<td>{{ Form::text('proyecto', '' ,['class' =>'form-control ', 'data-txt-']) }}</td>'+
                                    '<td>{{ Form::text('subproyecto', '' ,['class' =>'form-control', 'data-txt-']) }}</td>'+
                                    '<td>{{ Form::text('user_id', '',['class' =>'typeahead form-control','data-txt-']) }}</td>'+
                                    '<td>{{ Form::text('amount', '',['class' =>'form-control','data-txt-']) }}</td>'+
                                    '<td> {{ Form::select('active', array('1' => 'Activo', '0' => 'Inativo'),1,['class' =>'form-control '])  }}</td>'+
                                    '<td><span data-iden="1" class ="glyphicon-success glyphicon glyphicon-floppy-disk edit-project" data-id=""></span><span class ="glyphicon-warning glyphicon glyphicon-remove project-r-"></span></td>'+
                                    '<td><span data-iden="1" class ="glyphicon-success glyphicon glyphicon-floppy-disk edit-project" data-id=""></span><span class ="glyphicon-warning glyphicon glyphicon-remove project-r-"></span></td>'+
                                    '</tr>';
                        }
                    });
                </script>
            </div>

            {{--<a href="#" id="Element"> Este es a crear </a>--}}
@endsection