@extends('layouts.app')

@section('jsscript')
    <script src="{{asset('js/orders.js')}}"></script>
@endsection

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
            <th>Cliente</th>
            <th>Pedido</th>
            <th>Fecha Pedido</th>
            <th>Monto Pedido</th>
            <th>Tipo Env&iacute;o</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        @isset($orders)
            @foreach ($orders as $order)
                <tr>
                    <td>{{$order->id_order}}</td>
                    <td>{{$order->first_name_order." ".$order->last_name_order}}</td>
                    <td>{{$order->reason_order}}</td>
                    <td>{{$order->date_created_order}}</td>
                    <td>{{$order->total_amount_order}}</td>
                    <td>{{$order->shipping_type_order}}</td>
                    <td>{{$order->intl_status}}</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalDetalle" 
                                data-orderid="{{$order->id}}">
                            Detalles
                          </button>

                    </td>
                </tr>
            @endforeach
        @endisset
    </table>
    @include('includes.modal',[
        'modalId'=>'modalDetalle',
        'modalTitle'=>'Detalle del Pedido',
        'modalBotonCerrar'=>'Cerrar',
        'modalSize'=>'modal-xl',
        'modalBotonAceptarId'=>'saveOrderDetail',
        'modalBotonAceptar'=>'Guardar',
        'modalBodyId'=>'orderBody'
    ])
@endsection