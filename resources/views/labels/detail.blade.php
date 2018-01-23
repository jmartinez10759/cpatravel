@extends('layouts.app')

@section('content')
    <style>
        .icon-tam {
            font-size: 25px;
            padding-left: 10px;
        }

        .icon-tam2 {
            font-size: 40px;
            padding-left: 10px;
            text-align: center;
        }

        .nombre-etiquetas{

            background: #e2e2e1;
            border-top-left-radius:10px;
            border-bottom-left-radius: 10px;
            padding: 1.5%;
            color:#303082;
            font-size: 14px;
            text-align: center;
        }

        .nombre-etiquetas2{

            background: #e2e2e1;
            border-radius: 10px;
            padding: 1.5%;
            color:#303082;
            font-size: 14px;
            text-align: center;
        }


        .proyecto-etiquetas{

            background: #e2e2e1;
            padding: 1.5%;
            color:#303082;
            font-size: 14px;
            text-align: center;
        }
        .subproyecto-etiquetas{

            background: #e2e2e1;
            border-top-right-radius:10px;
            border-bottom-right-radius: 10px;
            padding: 1.5%;
            color:#303082;
            font-size: 14px;
            text-align: center;
        }
        #etiquetas-agregadas{
            height:auto;
            overflow: auto;
        }
        .main{
            margin:50px 120px;
        }
        .input-text{
            width:300px;
            background: transparent;
        }
        .input-textarea{
            background: transparent;
        }
        .input-file{
            background: transparent;
        }
        .input-select{
            background: transparent;
        }
    </style>
    <div class="main">
        <div class="row titulo-pantalla-azul">
            <div class="col-md-12 col-sm-12 col-xs-6 center">
                <div class="about-item scrollpoint sp-effect2" style="text-align: center;padding-top: 44px;">
                    <span class="icon-icon_detallesetiqueta icon-tam2"></span>
                    DETALLE DE LA ETIQUETA PREDETERMINADA
                </div><! --/about-item -->
            </div><! --/col-md-3 -->
        </div>
        <div class="row">
            <form action="">
                <table class="table">
                    <input type="text" name="" value="{{ $label->iden }}" id="">
                <tr>
                    <td>Logo</td>
                    <td>
                        <input type="file" name="" id="" class="form-control input-file">
                    </td>
                    <td>
                        Nombre de Etiqueta
                    </td>
                    <td>
                        <input type="text" name="" id="" value="{{ $label->name }}" class="form-control input-text">
                    </td>
                </tr>
                <tr>
                    <td>
                        Descripción
                    </td>
                    <td colspan="2">
                        <textarea name="" id="" cols="30" rows="10" class="form-control input-textarea"> {{ $label->description }}</textarea>
                    </td>
                    <td>
                        <select name="" id="" class="form-control input-select">
                            <option value=""> Requisitos Legales para la deducibilidad</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2">
                        Nacional
                    </td>
                    <td colspan="2">
                        Extranjero
                    </td>
                </tr>
                <tr>
                    <td>Monto máximo fiscal diarío</td>
                    <td colspan="2">
                        <input type="text" name="" id="" class="form-control input-text" value="$ {{ $label->national_maximum_deductible_amount }}" placeholder="$">
                    </td>
                    <td >
                        <input type="text" name="" id="" class="form-control input-text" value="$ {{ $label->foreign_maximum_deductible_amount }}" placeholder="$">
                    </td>
                </tr>
                <tr>
                    <td>
                        Monto máximo corporativo
                    </td>
                    <td colspan="2">
                        <input type="text" name="" id="" class="form-control input-text" value="$ {{ $label->national_company_policies }}" placeholder="$">
                    </td>
                    <td >
                        <input type="text" name="" id="" class="form-control input-text" value="$ {{ $label->foreign_company_policies }}" placeholder="$">
                    </td>
                </tr>
            </table>
            </form>
        </div>
        <div class="row">
            <div class="col-md-12">
                <input type='button'  onclick="blurStuff(0)"  value='Cancelar' class='save btn btn-sm btn-cancelar pull-right'>
                <input type='button'  value='Guardar' class='save btn btn-sm btn-save pull-right'>
            </div>

        </div>
    </div>
@endsection