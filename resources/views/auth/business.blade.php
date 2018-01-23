@extends('layouts.app')

@section('content')

            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <table align="center" class="table table-striped">
                        <thead>
                            <tr>
                                <th align="center">
                                    Empresas
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($business as $bu )
                                <tr>
                                    <td align="center" >
                                        <a href="{{ route('home') }}">
                                            {{ $bu->name }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>

@endsection