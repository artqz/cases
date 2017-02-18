@extends('app')

@section('content')
    <div>
        {!! Breadcrumbs::render('shop') !!}
        <h1>Магазин</h1>
        <h2>Игры</h2>
        <div class="items-list row">
            @foreach($games as $game)
                <div class="col-xs-6 col-sm-3 col-md-3">
                    <div class="items-item">
                        <div class="item-name">{{ $game->name }}</div>
                        <img src="{{ $game->header_image }}" alt="{{ $game->name }}">
                        <div class="item-price">Цена: {{ $game->price }} Клик.</div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-12 row">
            <a class="btn btn-sm btn-success" href="{{ url('shop/games') }}">Посмотреть все игры</a>
        </div>
        <br><br>
        <h2>Вещи</h2>
        <div class="items-list row">
            @foreach($items as $item)
                <div class="col-xs-6 col-sm-3 col-md-3">
                    <div class="items-item">
                        <div class="item-name">{{ $item->name }}</div>
                        <img src="http://steamcommunity-a.akamaihd.net/economy/image/{{ $item->icon_url_large }}" alt="{{ $item->name }}">
                        <div class="item-price">Цена: {{ $item->price }} Клик.</div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-12 row">
            <a class="btn btn-sm btn-success" href="{{ url('shop/items') }}">Посмотреть все вещи</a>
        </div>
    </div>
@endsection


@section('style')
    <style>
        button[disabled], html input[disabled] {
            cursor: no-drop;
        }
        .items-list {

        }
        .items-item {
            margin-bottom: 15px;
            display: block;
            color: #777;
            border: 1px solid #e3e3e3;
            padding: 10px;
            background-color: white;
            position:relative;
        }
        .items-item img {
            width: 100%;
        }
        .item-name {
            color: #a04eb4;
            margin-bottom: 7px;
        }
        .item-price {
            margin-top: 15px;
            font-size: 11px;
            color: #b2b2b2;
        }
    </style>
@endsection