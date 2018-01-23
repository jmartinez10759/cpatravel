@foreach($data as $c)
    <tr>
        <td>
            <a href="#" class="href_city_2" data-name="{{ $c->name }}" data-id="{{ $c->id }}">
                {{ $c->name }}
            </a>
        </td>
    </tr>

@endforeach
<script>
    $(document).ready(function(){
        $('.href_city_2').unbind().bind('click',function(){
            $('#destino_final').val($(this).attr('data-name'));
            $('#id_destino_final').val($(this).attr('data-id'));
            $('#myModal2').modal('hide');
        });
    });
</script>