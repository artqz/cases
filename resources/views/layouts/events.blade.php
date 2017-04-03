@section('events')
    @foreach($events as $event)
        <li>{{ $event->text }}</li>
    @endforeach
@endsection