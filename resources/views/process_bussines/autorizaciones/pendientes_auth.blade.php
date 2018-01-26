@extends('template.dashboard-container')
@section('content')
    <style>
        .titulo-pantalla{
            text-align: center;
            color: #009577;
            font-size: 30px;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .head-proyecto{
            color:#ffffff;
            background: #303082;
            border-top-left-radius: 18px;
            border-bottom-left-radius: 18px;
            font-size: 12px;
            padding: 15px;
            text-align: center;
        }

        .head-subproyecto{
            color:#ffffff;
            background: #303082;
            font-size: 12px;
            padding: 10px;
            text-align: center;
        }
        .head-viaje{
            color:#ffffff;
            background: #303082;
            font-size: 12px;
            padding: 10px;
            text-align: center;
        }
        .head-monto{
            color:#ffffff;
            background: #303082;
            font-size: 12px;
            padding: 10px;
            text-align: center;
        }
        .head-fecha{
            color:#ffffff;
            background: #303082;
            font-size: 12px;
            padding: 10px;
            text-align: center;
        }



        .head-dias{
            color:#ffffff;
            background: #303082;
            border-top-right-radius: 18px;
            border-bottom-right-radius: 18px;
            font-size: 12px;
            padding: 10px 30px 10px 10px;
            text-align: left;
            height: auto;

        }

        .icon-tam2 {
            font-size: 40px;
            padding-left: 10px;
            text-align: center;

        }

        td{
            color:#303082;
            font-size: 15px;
            vertical-align: middle;
            text-align: center;
            padding: 20px;


        }
        .datos-auto {
            border-bottom:#008e7e 1px solid;
        }

        .tabla {
            margin-top: 20px;
        }

        .conten-img-title{
            font-size: 18px;
            color: #4a9477;
            padding-top: 20px;
        }
        .label-fechas{
            font-size: 16px;
            color: #6f6f6e;
        }
        .form-fecha{
            border-radius: 5px;
            border:#33337f solid 1px;
            width: 80px;
            margin-top: 5px;
        }
        .form-search{
            border-radius: 5px;
            border:#33337f solid 1px;
            width: 160px;
            margin-top: 5px;
        }

        .form-search2{
            border-radius: 5px;
            border:#33337f solid 1px;
            width: 90%;
            margin-top: 5px;
            padding: 5px;
        }
        #dias{
            display: inline-block;
            padding: 16px;
            text-align: center;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: #c9dde0;
            vertical-align: middle;
            margin-top: 10px;
        }
        .label-dia{
            margin-top: 10%;
            display: inline-block;
        }
        .element-viatico{
            font-size: 60px;
            cursor: pointer;
        }
        .element-div{
            padding-left: 5px;
            padding-top: 10px;
        }
        .element-div-left{
            padding-left: 20px;
            padding-top: 10px;
        }
        .element-list{
            font-size: 33px;
        }
        .in-line{
            display: inline-block;
        }
        .element-div{
            padding: 10px;
            cursor: pointer;
        }

        #tabla-debito {

            background:#e8e9e8;
            padding: 10px;
            color:#4A9477;
            font-size:15px;
            text-align: center;
        }

        #tabla-cheques {
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
            background:#e8e9e8;
            padding: 10px;
            color:#4A9477;
            font-size:15px;
            text-align: center;
        }

        #tabla-credito {
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
            background:#e8e9e8;
            padding: 10px;
            color:#4A9477;
            font-size:15px;
            text-align: center;
        }

        #tabla-efectivo {

            padding: 10px;
            color:#4A9477;
            font-size:15px;
            text-align: center;
        }

        #tabla-amex {

            padding: 10px;
            color:#4A9477;
            font-size:15px;
            text-align: center;
        }

        #nacional {
            background: #bfdadd;
            border-radius: 10px;
            padding-top: 25px;
            padding-bottom: 25px;
            padding-right: 5px;
            padding-left: 5px;
            text-align: center;
            margin-right: 3px;
        }

        #extranjero {
            background: #bfdadd;
            border-radius: 10px;
            padding-top: 25px;
            padding-bottom: 25px;
            padding-right: 5px;
            padding-left: 5px;
            text-align: center;
            margin-right: 3px;
        }
        #total{
            display: inline-block;
            padding-top: 25px;
            padding-bottom: 10px;
            text-align: center;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: #008e7e;
            color: white;
            font-size: 30px;
            vertical-align: middle;

        }

        #autorizacion{
            display: inline-block;
            padding-top: 25px;
            padding-bottom: 10px;
            text-align: center;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: #008e7e;
            color: white;
            font-size: 30px;
            vertical-align: middle;

        }

        .texto{
            font-size: 16px;
            color: #706f6f;
            text-align: center;
        }

        .center{
            text-align: center;
        }

        .enviar-btn{
            background-color: #e97a6f;
            border-radius: 10px;
            color:#ffffff;
            border:none;
            font-size: 12px;
            vertical-align: middle;
            padding: 8px;
            margin-top: 40px;
            margin-left: 20px;
            text-align: center;

        }

        .icon-tam2 {
            font-size: 40px;
            padding-left: 10px;
            text-align: center;
            vertical-align: middle;

        }

        .titulo-pantalla{
            text-align: center;
            color: #009577;
            font-size: 30px;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .numero-dias{
            font-size: 30px;
            color:#303082;
        }

        .dias-txt{
            color:#303082;
            font-size: 17px;
        }

        th, td{
            color:#303082;
            font-size: 15px;
            vertical-align: middle;

        }

        hr {
            border:#008e7e 1px solid;
        }
        h2{
            font-size: 18px;
            color: white;
        }
    </style>

    <div class="container">
        <div class="row titulo-pantalla">
            <div class="col-md-12 col-xs-12">
                <span class="icon-aut_pendientes icon-tam2"></span>
                AUTORIZACIONES PENDIENTES
            </div>

        </div>
        <div class="row">
            <div class="panel panel-default" style="background: transparent; border-color: transparent;">
                
                <div class="col-sm-5">
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <div class="conten-img">
                                <img alt="User Pic" src="{{$avatar}}" class="img-circle img-responsive img-profile">
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="conten-img-title">
                                USUARIO: {{$usuario}}
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>

        </div>


        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    
                    {!! $table_pendientes !!}

                </div>
            </div>
        </div>




        <span class="icon-detalle"></span>
        <span class="icon-icon_cancelar"><span class="path1"></span><span class="path2"></span><span class="path3"></span></span>
        <span class="icon-autorizar_inactivo"><span class="path1"></span><span class="path2"></span><span class="path3"></span></span>
        
    </div>
    <script>
        $(document).ready(function(){
            $('.total').number(true,2)
        });
    </script>

@endsection