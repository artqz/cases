@extends('app')

@section('title', 'Магазин - ')

@section('content')
    <div>
        {!! Breadcrumbs::render('shop') !!}
        <h1>Магазин</h1>
        <p>Добро пожаловать в магазин игр и предметов для платформы Steam.</p>
        <p>В нашем магазине игры не продаются за деньги, а даются пользователям за клики, которые можно получить только в нашем <a
                    href="{{ url('faucet') }}">Кликере</a>.</p>
        <h3>Игры</h3>
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
        <h3>Вещи</h3>
        <div class="items-list row">
            @foreach($items as $item)
                <div class="col-xs-6 col-sm-3 col-md-3">
                    <div class="items-item">
                        <div class="item-name">{{ $item->name }}</div>
                        <img src="{{ $item->icon_url }}" alt="{{ $item->name }}">
                        <div class="item-price">Цена: {{ $item->price }} Клик.</div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-12 row">
            <a class="btn btn-sm btn-success" href="{{ url('shop/items') }}">Посмотреть все вещи</a>
        </div>
        <br><br>
        <div class="row">
            <div class="col-md-6">
                <h3>Последние купленные вещи</h3>
                <ul class="last-buy-items-list">
                    @foreach($last_buy_items as $last_buy_item)
                        <li class="last-buy-items-item">
                            <span class="item-buy-name"><img src="{{ $last_buy_item->icon_url_large }}" alt="{{ $last_buy_item->name }}"> {{ $last_buy_item->name }}</span>
                            @if($last_buy_item->status == 1)<span class="label label-default">Ожидание выдачи</span>@elseif($last_buy_item->status == 2)<span class="label label-success">Выдано</span>@endif
                            <div class="pull-right">
                                <span class="item-user"><img src="https://secure.gravatar.com/avatar/{{ $last_buy_item->user->email_hash }}?s=32&d=identicon"> {{ $last_buy_item->user->name }}</span>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-6">
                <h3>Последние купленные игры</h3>
                <ul class="last-buy-items-list">
                    @foreach($last_buy_games as $last_buy_game)
                        <li class="last-buy-items-item">
                            <span class="item-buy-name"><img src="{{ $last_buy_game->header_image }}" alt="{{ $last_buy_game->name }}"> {{ $last_buy_game->name }}</span>
                            <span class="label label-success">Выдано</span>
                            <div class="pull-right">
                                <span class="item-user"><img src="https://secure.gravatar.com/avatar/{{ $last_buy_game->user->email_hash }}?s=32&d=identicon"> {{ $last_buy_game->user->name }}</span>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('sidebar')
    @if (\Auth::id() == \Config::get('main.admin_id'))
        <div class="panel panel-default">
            <div class="panel-body">
                <div>Тут можно добавить игру или предмет</div><br>
                <a class="btn btn-sm btn-success" href="{{ url('shop/games/create-game') }}">Добавить игру</a>
                <hr>
                <a class="btn btn-sm btn-success" href="{{ url('shop/items/create-item') }}">Добавить предмет</a>
            </div>
        </div>
    @endif

    @widget('lastBuyItems')

    @widget('lastBuyGames')

    @widget('lastPosts')
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
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .item-price {
            margin-top: 15px;
            font-size: 11px;
            color: #b2b2b2;
        }

        .last-buy-items-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .item-date {
            font-size: 10px;
            color: #b2b2b2;
        }
        .item-buy-name {
            padding-left: 25px;
            color: #a04eb4;
            margin-bottom: 7px;
            position: relative;
        }
        .item-buy-name img {
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
        .item-user img {
            width:20px;
            height:20px;
            position:absolute;
            top:-2px;
            left:0px;
            border-radius:50%;
        }
        .last-buy-items-item {
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