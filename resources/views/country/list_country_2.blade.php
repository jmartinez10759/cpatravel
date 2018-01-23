@foreach($data as $c)
    <tr>
        <td>
            <a href="#" class="href_country_2" data-id="{{ $c->id }}">
                {{ $c->name }}
            </a>
        </td>
    </tr>

@endforeach
<script>
    $(document).ready(function(){
        $('.href_country_2').unbind().bind('click',function(){
            $('#table_city_2').removeClass('hidden');
            $.ajax({
                url:"{{ route('search_city_2') }}",
                type:'GET',
                data:{
                    id : $(this).attr('data-id')
                },success:function(data){
                    $('#body_table_city_2').html(data);
                },error:function(e){

                }
            });
        });
    });
</script>