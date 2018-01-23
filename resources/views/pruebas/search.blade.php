<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

<div class="container">

    <h1>Laravel 5 Autocomplete using Bootstrap Typeahead JS</h1>
    <input class="typeahead form-control" style="margin:0px auto;width:300px;" type="text" id="name">
    <input class=" form-control" style="margin:0px auto;width:300px;" type="text" id="id">

</div>

<script type="text/javascript">
    var path = "{{ route('autocomplete') }}";
    $('input.typeahead').typeahead({
        source:  function (query, process) {
            return $.get(path, { query: query }, function (data) {
                //console.log(data);
                return process(data);
            });
        },updater:function (selection) {
            $('#id').val(selection.id);
            return selection.name;
        }
    });
</script>

</body>
</html>