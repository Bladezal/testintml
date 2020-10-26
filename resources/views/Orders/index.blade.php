@extends('Layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Listado de Pedidos </h2>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p></p>
        </div>
    @endif

    <table class="table table-bordered table-responsive-lg">
        <tr>
            <th>Id Pedido</th>
            <th>Fecha Pedido</th>
            <th>Fecha Finalizaci&oacute;n</th>
            <th>Estado Pedido</th>
            <th>Monto Pedido</th>
            <th>Moneda</th>
            <th>Nombre Cliente</th>
            <th>Apellido Cliente</th>
            <th>Id Env&iacute;o</th>
            <th>Notas</th>
            <th>Estado Interno</th>
        </tr>
        @isset($orders)
            @foreach ($orders as $order)
                <tr>
                    <td>{{$order->id_order}}</td>
                    <td>{{$order->date_created_order}}</td>
                    <td>{{$order->date_closed_order}}</td>
                    <td>{{$order->status_order}}</td>
                    <td>{{$order->total_amount_order}}</td>
                    <td>{{$order->currency_id}}</td>
                    <td>{{$order->first_name_order}}</td>
                    <td>{{$order->last_name_order}}</td>
                    <td>{{$order->shipping_id_order}}</td>
                    <td>{{$order->notes}}</td>
                    <td>{{$order->intl_status}}</td>
                </tr>
            @endforeach
        @endisset
    </table>

@endsection