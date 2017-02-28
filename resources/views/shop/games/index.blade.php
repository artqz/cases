@extends('app')

@section('title', 'Игры - Магазин - ')

@section('content')
    <div>
        @include('layouts.flash')
        {!! Breadcrumbs::render('games') !!}
        <h1>Игры</h1>
        <div class="games-list row">
            @foreach($games as $game)
                <div class="col-xs-6 col-sm-3 col-md-3">
                    <div class="games-item">
                        <div class="game-name">{{ $game->name }}</div>
                        <img src="{{ $game->header_image }}" alt="{{ $game->name }}">
                        <div class="game-price">Цена: {{ $game->price }} Клик.</div>
                        <div class="pull-right"><a href="{{ url('/shop/games/'. $game->id .'/buy-game') }}" class="btn btn-xs btn-default">Купить</a></div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="clearfix"></div>
        <div>{{$games->links()}}</div>
    </div>
@endsection

@section('sidebar')
    @if (\Auth::id() == \Config::get('main.admin_id'))
        <div class="panel panel-default">
            <div class="panel-body">
                <div>Тут можно добавить игру или предмет</div><br>
                <a class="btn btn-sm btn-success" href="{{ url('shop/games/create-game') }}">Добавить игру</a>
            </div>
        </div>
    @endif
@endsection


@section('style')
    <style>
        .games-list {

        }
        .games-item {
            margin-bottom: 15px;
            display: block;
            color: #777;
            border: 1px solid #e3e3e3;
            padding: 10px;
            background-color: white;
            position:relative;
        }
        .games-item img {
            width: 100%;
        }
        .game-name {
            color: #a04eb4;
            margin-bottom: 7px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .game-price {
            margin-top: 15px;
            font-size: 11px;
            color: #b2b2b2;
        }

        .last-buy-games-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .game-date {
            font-size: 10px;
            color: #b2b2b2;
        }
        .game-buy-name {
            padding-left: 25px;
            color: #a04eb4;
            margin-bottom: 7px;
            position: relative;
        }
        .game-buy-name img {
            width:20px;
            height:20px;
            position:absolute;
            top:-2px;
            left:0px;
            border-radius:50%;
        }
        .item-user {
            padding-left: 25px;
            color: #a04eb4;
            margin-bottom: 7px;
            position: relative;
        }
        .game-user img {
            width:20px;
            height:20px;
            position:absolute;
            top:-2px;
            left:0px;
            border-radius:50%;
        }
        .last-buy-games-item {
            margin-bottom: 15px;
            display: block;
            color: #777;
            border: 1px solid #e3e3e3;
            padding: 10px;
            background-color: white;
            position:relative;
        }
    </style>
@endsection
