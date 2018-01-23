<ul class="tree">
    @foreach($data as $dat)
        <li>
            <input type="checkbox" id="p-{{ $dat['project']['id'] }}" />
            <label data-type="1" data-id="{{ $dat['project']['id'] }}" class="tree_label" for="p-{{ $dat['project']['id'] }}">
                <i class="fa fa-suitcase" aria-hidden="true"></i>
                {{ $dat['project']['name'] }}
            </label>
            <ul>
                <li>
                    <input type="checkbox" id="s-{{  $dat['subproject']['id'] }}" />
                    <label  data-type="2"  data-id="{{ $dat['subproject']['id'] }}" class="tree_label" for="s-{{$dat['subproject']['id']}}">
                        <i class="fa fa-folder-open" aria-hidden="true"></i> {{ $dat['subproject']['name'] }}
                    </label>
                    <ul>
                            <li>
                                <i class="fa fa-plane" style="color: #2C398E;" aria-hidden="true"></i>
                                <span class="tree_label" data-type="3" data-id="{{ $dat['travel']['id'] }}" style="cursor: pointer;">{{ $dat['travel']['name'] }}</span>
                            </li>
                    </ul>
                </li>
            </ul>
            <?php //dd($dat); ?>

        </li>
        @endforeach
</ul>


<script>
    $(document).ready(function(){
        clearFormProject();
        $('#register_project').unbind().bind('click',function(){
            $datForm = $('#form_project_id').serialize();
            $.ajax({
                url:"{{ route('project.store') }}",
                type:'POST',
                data : $datForm,
                dataType: 'json',
                success:function(data){
                    if(data.success){
                        ListProject();
                    }
                },error:function(){
                    alert('Intenta mas tarde ...');
                }
            });

        });

        $('#register_subproject').unbind().bind('click',function(){
            $formSubproject = $('#form_subproject_id').serialize();
            $.ajax({
                url:'{{ route("subproject.store") }}',
                data: $formSubproject,
                type:'POST',
                dataType: 'json',
                success:function(data){
                    ListProject();

                },error:function(data){

                }
            });
        });

        $('.add_new_project').unbind().bind('click',function(){
            clearFormProject();
        });

        $('#content-plus-project').unbind().bind('click',function(){
            clearFormSubProject();
        });

        $('.tree_label').unbind().bind('click',function(){
            $data_type = $(this).attr('data-type');
            $id = $(this).attr('data-id');
            $route="";
            switch(parseInt($data_type)){
                case 1:
                    $route = "{{ url('project/') }}"+"/"+$id;
                    $('#content-plus-project').removeClass('hidden');
                    break;
                case 2:
                    $route = "{{ url('subproject/') }}"+"/"+$id;
                    $('#content-plus-subproject').removeClass('hidden');
                    break;
                case 3:
                    $route = "{{ url('travel/') }}"+"/"+$id;

                    break;
                default:
            }

            $.ajax({
                url : $route,
                type:'GET',
                dataType: 'json',
                success:function(data){
                    switch(parseInt($data_type)){
                        case 1:
                            fillFormProject(data);
                            break;
                        case 2:
                            fillFormSubProject(data)
                            break;
                        case 3:
                            fillFormTravel(data);
                            break;
                        default:
                    }

                },error:function(data){
                    alert('Intenta mas tarde ...');
                }
            });

        });
    });

    function clearFormSubProject(){
        $project_id = $('#txt_pro_id').val();
        $name_project = $('#txt_pro_name').val();
        console.log($project_id);
        console.log($name_project);
        $('.label-name-project').text($name_project);
        $('#txt_project_id_subproject').val($project_id);
        $('.panel_project').addClass('hidden');
        $('.panel_sub_project').removeClass('hidden');
    }



    function fillFormProject(data){
        $('.info_user_pro').removeClass('hidden')
        $('#txt_pro_id').val(data.project.id);
        $('#txt_pro_name').val(data.project.name);
        $('#txt_pro_descr').val(data.project.description);
        $('#txt_pro_activo option[value="'+data.project.active+'"]').attr("selected", "selected");
        $('.fecha-pro').text('Fecha: '+data.project.created_at);
        $('.label-user-project').text('Autor: '+ data.user.original.data.name+ ' '+data.user.original.data.las_name);

        $('.panel_sub_project').addClass('hidden');
        $('.panel_viaje').addClass('hidden');
        $('.panel_project').removeClass('hidden');
    }

    function fillFormSubProject(data){
        $('.info_user_subpro').removeClass('hidden');
        $('#txt_subproject_id').val(data.subproject.id);
        $('#txt_project_id_subproject').val(data.subproject.project_id);
        $('.label-name-subproject').text(data.project.name);
        $('#txt_subpro_name').val(data.subproject.name);
        $('#txt_subpro_descr').val(data.subproject.description);
        $('#txt_subpro_activo option[value="'+data.subproject.active+'"]').attr("selected", "selected");
        $('.fecha-subpro').text('Fecha: '+data.subproject.created_at);
        $('.label-user-subproject').text('Autor: '+ data.user.original.data.name+ ' '+data.user.original.data.las_name);
        $('.panel_sub_project').removeClass('hidden');
        $('.panel_viaje').addClass('hidden');
        $('.panel_project').addClass('hidden');
    }

    function clearFormProject(){
        $('.info_user_pro').addClass('hidden')
        $('#txt_pro_id').val('');
        $('#txt_pro_name').val('');
        $('#txt_pro_descr').val('');
        $('#txt_pro_activo option[value=1]').attr("selected",true);
        $('#txt_pro_activo option[value=0]').attr("selected",false);
        $('.fecha-pro').text('Fecha: ');

        $('.panel_project').removeClass('hidden');
        $('.panel_sub_project').addClass('hidden');
        $('.panel_viaje').addClass('hidden');
        $('#content-plus-project').addClass('hidden');
    }

    function fillFormTravel(data) {
        $('.info_user_travel').removeClass('hidden')
        $('#txt_travel_id').val(data.travel.id);
        $('#txt_travel_name').val(data.travel.name);
        $('#txt_travel_descr').val(data.travel.description);
        $('#txt_travel_activo option[value="'+data.travel.active+'"]').attr("selected", "selected");
        $('#txt_travel_id_project').val(data.project.id);
        $('#txt_travel_id_subproject').val(data.subproject.id);
        $('.fecha-travel').text('Fecha: '+data.travel.created_at);
        $('.label-user-travel').text('Autor: '+ data.user.original.data.name+ ' '+data.user.original.data.las_name);
        $('.label-name-project').text(data.project.name);
        $('.label-name-subproject').text(data.subproject.name);
        $('.panel_sub_project').addClass('hidden');
        $('.panel_viaje').removeClass('hidden');
        $('.panel_project').addClass('hidden');
    }


    function ListProject() {
        $.ajax({
            url : "{{ route('list_project') }} ",
            type:'GET',
            success:function(data){

                $('#list_project').html(data);
            },error:function(data){

            }
        });

    }

</script>