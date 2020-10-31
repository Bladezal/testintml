@extends('layouts.app')

@section('content')
    <h2 class="mt-5">Listado de Cuentas </h2>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p></p>
        </div>
    @endif

    <table class="table table-bordered table-responsive-lg">
        <tr>
            <th>Id Cuenta</th>
            <th>Nombre Cuenta</th>
            <th>Estado Vinculaci&oacute;n</th>
            <th>Fecha Vinculaci&oacute;n</th>
        </tr>
        @isset($accounts)
            @foreach ($accounts as $account)
                <tr>
                    <td>{{$account->}}</td>
                    <td>{{$account->}}</td>
                    <td>{{$account->}}</td>
                    <td>{{$account->}}</td>
                </tr>
            @endforeach
        @endisset
    </table>

@endsection