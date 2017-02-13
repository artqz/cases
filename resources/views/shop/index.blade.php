@extends('app')

@section('content')
    <div class="container">
        <h1>Магазин</h1>
        <h2>Игры</h2>
        ...
        <h2>Вещи</h2>
        ...
    </div>
@endsection


@section('style')
    <style>
        button[disabled], html input[disabled] {
            cursor: no-drop;
        }
    </style>
@endsection