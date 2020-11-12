<div class="row">
    <div class="col-md-4 order-md-2 mb-4">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Detalle</span>
        </h4>
        <ul class="list-group mb-3">
            @foreach ($detail as $item)
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <div class="row">
                            <h6 class="my-0">{{$item->item->title}}</h6>
                        </div>
                        <div class="row">
                            <small class="text-muted">Cantidad: {{$item->quantity}}</small>
                        </div>
                        <div class="row">
                            <small class="text-muted">Precio unitario: {{$item->unit_price}}</small>
                        </div>
                        <div class="row">
                            <small class="text-muted">Total producto: {{$item->full_unit_price}}</small>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        <form>
            <div class="form-group">
                <label>Notas: </label>
                <textarea class="form-control" id="ordernotes" rows="3">
                    @isset($order->notes)
                    {{$order->notes}}    
                    @endisset
                </textarea>
            </div>
            <div class="form-group">
                <label>Estado: </label>
                <select class="form-control" id="orderstatus">
                    @foreach ($status as $state)
                        <option value="{{$state->id}}">{{$state->description}}</option>
                    @endforeach
                </select>
            </div>
        </form>    
    </div>
    <div class="col-md-8 order-md-1">
        <div class="card border-secondary">
            <div class="card-body text-secondary">
                <form>
                    @csrf
                    <input type="hidden" id="orderid" value="{{$order->id}}">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Id Pedido: </label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" value="{{$order->id_order}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Cliente: </label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" value="{{$order->first_name_order." ".$order->last_name_order}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Fecha Pedido: </label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" value="{{$order->date_created_order}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Monto Pedido: </label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" value="{{$order->total_amount_order}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tipo Env&iacute;o: </label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" value="{{$order->shipping_type_order}}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>