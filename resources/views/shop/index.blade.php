@extends('app')

@section('title', 'Магазин - ')

@section('content')
    <div>
        {!! Breadcrumbs::render('shop') !!}
        <h1>Магазин</h1>
        <p>Добро пожаловать в магазин игр и предметов для платформы Steam.</p>
        <p>В нашем магазине игры не продаются за деньги, а даются пользователям за клики, которые можно получить только в нашем <a
                    href="{{ url('faucet') }}">Кликере</a>.</p>

        <div class="row">
            <div class="col-md-6">
                <a href="{{ url('shop/games') }}" class="all-games">
                    <h2>Игры</h2>
                    <div class="games-list row">
                        @foreach($games as $game)
                            <div class="col-sm-6 col-md-6">
                                <div class="game-card">
                                    <div class="game-name">{{ $game->name }}</div>
                                    <div class="game-image"><img src="{{ $game->header_image }}" alt="{{ $game->name }}"></div>
                                    <div class="price"><span>{{ $game->price }}</span></div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </a>
            </div>
            <div class="col-md-6">
                <a href="{{ url('shop/items') }}" class="all-items">
                    <h2>Предметы</h2>
                    <div class="items-list row">
                        @foreach($items as $item)
                            <div class="col-sm-6 col-md-6">
                                <div class="item-card">
                                    <div class="item-name">{{ $item->name }}</div>
                                    <div class="category-icon"><img src="{{ url('images/games/icons/'.$item->category->appid.'.jpg') }}" alt="{{ $item->category->name }}"></div>
                                    <div class="item-image"><img src="{{ $item->icon_url }}" alt="{{ $item->name }}"></div>
                                    <div class="price"><span>{{ $item->price }}</span></div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </a>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
                <ul class="last-buy-games-list">
                    <h3>Последние купленные игры</h3>
                    @foreach($last_buy_games as $game)
                        <li class="last-buy-game-card">
                            <div class="game-image"><img src="{{ $game->header_image }}" alt="{{ $game->name }}"></div>
                            <div class="game-name">{{ $game->name }}</div>
                            <div class="game-buyer">{{ $game->user->name }}</div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-6">
                <h3>Последние купленные вещи</h3>
                <ul class="last-buy-items-list">
                    @foreach($last_buy_items as $item)
                        <li class="last-buy-item-card">
                            <div class="category-icon"><img src="{{ url('images/games/icons/'.$item->category->appid.'.jpg') }}" alt="{{ $item->category->name }}"></div>
                            <div class="item-image"><img src="{{ $item->icon_url }}" alt="{{ $item->name }}"></div>
                            <div class="item-name">{{ $item->name }}</div>
                            <div class="item-buyer">{{ $item->user->name }}</div>
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

    @widget('WidgetChat')

    @include('widgets.reklama')

    @include('widgets.vk')


@endsection