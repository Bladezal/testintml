@extends('layouts.app')

@section('jsscript')
    <script src="{{asset('js/states.js')}}"></script>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ESTADOS</div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @isset($states)
                            @foreach ($states as $item)
                                <li class="list-group-item">{{$item->description}} ({{$item->status_code}})</li>      
                            @endforeach    
                        @endisset
                    </ul>
                    <form>
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Estado..." id="statusdesc">
                            <input type="text" class="form-control" placeholder="Código..." id="statuscode">
                            <div class="input-group-append">
                            <button class="btn btn-primary" type="button" id="addstatus">Button</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection