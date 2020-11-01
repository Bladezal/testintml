@include('layouts.app')

@section('content')
    <div class="alert alert-{{$message['result']}}">
        <p>{{$message['msg']}}</p>
    </div>
@endsection