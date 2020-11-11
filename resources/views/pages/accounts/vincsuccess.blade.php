@extends('layouts.app')

@section('content')
    <div class="alert alert-{{$message['result']}}" role="alert">
        {{$message['msg']}}
    </div>
@endsection