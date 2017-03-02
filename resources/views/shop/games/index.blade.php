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

    @widget('lastBuyItems')

    @widget('lastBuyGames')

    @widget('lastPosts')
@endsection
