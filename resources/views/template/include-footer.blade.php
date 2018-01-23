<!--Seccion de los script -->
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <!-- fin jquery iu -->
    <!--Plugin Foggy-->
    <script type="text/javascript" src="{{ asset('js/jquery.foggy.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.number.js') }}"></script>
    <!-- tyhead auto complete-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <!-- dropzone -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/dropzone.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/pnotify.custom.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/multiple-select.js') }}"></script>

    
    <script>

        function createNoty(message, type) {
            var html = '<div class="alert alert-' + type + ' alert-dismissable page-alert">';
            html += '<button type="button" class="close"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>';
            html += message;
            html += '</div>';
            $(html).hide().prependTo('#noty-holder').slideDown().slideUp(3500);
            $('.page-alert .close').click(function(e) {
                e.preventDefault();
                $(this).closest('.page-alert').slideUp();
            });
        };

        $(function(){

            $('.page-alert .close').click(function(e) {
                e.preventDefault();
                $(this).closest('.page-alert').slideUp();
            });
        });
        $().ready(function(){
             $('[data-toggle="tooltip"]').tooltip(); 
        })
    </script>