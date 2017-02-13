@extends('app')

@section('content')
    <div class="container">
        <h1>{{ $game->name }}</h1>
    </div>
@endsection


@section('style')
    <style>
        button[disabled], html input[disabled] {
            cursor: no-drop;
        }
    </style>
@endsection