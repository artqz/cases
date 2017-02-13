@extends('app')

@section('content')
    <div>
        {!! Breadcrumbs::render('shop') !!}
        <h1>Магазин - Игры</h1>

        <ul class="games-list">
        @foreach($games as $game)
            <li class="game-item col-xs-6 col-sm-4 col-md-4">
                <a href="{{ url('shop/game/' . $game->id) }}">
                    <img src="{{ $game->header_image }}" alt="{{ $game->name }}" width="100%">
                    <div>{{ $game->name }}</div>
                </a>
                <div>Количество: 0</div>
                <div>Купили: 0</div>
            </li>
        @endforeach
        </ul>
    </div>
@endsection

@section('sidebar')
    <div class="panel panel-default">
        <div class="panel-body">
            <div>Добавь игру если её нет!</div><br>
            <a class="btn btn-sm btn-success" href="{{ url('shop/game/create') }}">Добавить игру</a>
        </div>
    </div>
@endsection


@section('style')
    <style>
        button[disabled], html input[disabled] {
            cursor: no-drop;
        }
        .games-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .game-item {
            margin-bottom: 25px;
        }
    </style>
@endsection