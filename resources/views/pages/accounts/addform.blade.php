@extends('layouts')

@section('content')
<div class="card">
    <div class="card-header text-center font-weight-bold">
        Alta de Cuenta a vincular
    </div>
    <div class="card-body">
      <form name="agregarcuenta" id="agregarcuenta" method="post" action="{{url('save_account')}}">
       @csrf
        <div class="form-group">
          <label>Cuenta</label>
          <input type="text" id="cuenta" name="cuenta" class="form-control" required="">
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </form>
    </div>
  </div>
@endsection