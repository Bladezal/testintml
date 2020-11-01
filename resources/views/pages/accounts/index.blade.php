@extends('layouts.app')

@section('content')
    <h2 class="mt-5">Listado de Cuentas </h2>

    <table class="table table-bordered table-responsive-lg">
        <tr>
            <th>Id Cuenta</th>
            <th>Nombre Cuenta</th>
            <th>Estado Vinculaci&oacute;n</th>
            <th>Fecha Vinculaci&oacute;n</th>
            <th>Acciones</th>
        </tr>
        @isset($accounts)
            @foreach ($accounts as $account)
                <tr>
                    <td>{{$account->id}}</td>
                    <td>{{$account->nickname}}</td>
                    <td>{{($account->access_token) ? "Vinculado" : "No Vinculado"}}</td>
                    <td>{{$account->tkdate}}</td>
                    <th>@if (!$account->access_token)
                            <form name="vincularcuenta" id="vincularcuenta" method="post" action="{{url('getcode')}}">
                                @csrf
                                <input type="hidden" id="id_cuenta" name="id_cuenta" value="{{$account->id}}">
                                <button type="submit" class="btn btn-primary">Vincular Cuenta</button>
                            </form>
                        @else
                            <form name="obtenerpedidos" id="obtenerpedidos" method="post" action="{{url('getmlorders')}}">
                                @csrf
                                <input type="hidden" id="id_cuenta" name="id_cuenta" value="{{$account->id}}">
                                <button type="submit" class="btn btn-success">Obtener Pedidos</button>
                            </form>
                        @endif
                    </th>
                </tr>
            @endforeach
        @endisset
    </table>

@endsection