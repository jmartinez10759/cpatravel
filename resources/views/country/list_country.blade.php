@foreach($data as $c)
    <tr>
        <td>
            <a href="#" class="href_country" data-id="{{ $c->id }}">
                {{ $c->name }}
            </a>
        </td>
    </tr>

@endforeach
<script>
    $(document).ready(function(){
        $('.href_country').unbind().bind('click',function(){
            $('#table_city').removeClass('hidden');
            $.ajax({
                url:"{{ route('search_city') }}",
                type:'GET',
                data:{
                    id : $(this).attr('data-id')
                },success:function(data){
                    $('#body_table_city').html(data);
                },error:function(e){

                }
            });
        });
    });
</script>