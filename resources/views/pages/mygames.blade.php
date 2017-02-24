@extends('app')

@section('content')
    <div>
        @foreach($games as $game)
            {{ $game->name }}
        @endforeach
    </div>
@endsection