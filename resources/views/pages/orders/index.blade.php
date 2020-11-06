@extends('layouts.app')

@section('content')
    <h2 class="mt-5">Listado de Pedidos </h2>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p></p>
        </div>
    @endif

    <table class="table table-bordered table-responsive-lg">
        <tr>
            <th>Id Pedido</th>
            <th>Fecha Pedido</th>
            <th>Monto Pedido</th>
            <th>T&iacute;tulo Pedido</th>
            <th>Nombre Cliente</th>
            <th>Apellido Cliente</th>
            <th>Tipo Env&iacute;</th>
            <th>Notas</th>
            <th>Estado Interno</th>
            <th>Acciones</th>
        </tr>
        @isset($orders)
            @foreach ($orders as $order)
                <tr>
                    <td>{{$order->id_order}}</td>
                    <td>{{$order->date_created_order}}</td>
                    <td>{{$order->total_amount_order}}</td>
                    <td>{{$order->reason_order}}</td>
                    <td>{{$order->first_name_order}}</td>
                    <td>{{$order->last_name_order}}</td>
                    <td>{{$order->shipping_type_order}}</td>
                    <td>{{$order->notes}}</td>
                    <td>{{$order->intl_status}}</td>
                    <td></td>
                </tr>
            @endforeach
        @endisset
    </table>

@endsection