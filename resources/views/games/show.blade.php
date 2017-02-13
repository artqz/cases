@extends('app')

@section('content')
        {!! Breadcrumbs::render('game', $game->id) !!}
        @foreach($game->gifts as $gift)
            <div class="panel panel-default">
                <div class="panel-body">
                    {{ $gift->link }}
                    <a class="btn btn-xs btn-success pull-right">Купить игру за {{ $game->price_click }} кликов</a>
                </div>
            </div>
        @endforeach

@endsection

@section('sidebar')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h6>{{ $game->name }}</h6>
        </div>
        <div class="panel-body">
            <img src="{{ $game->header_image }}" alt="{{ $game->name }}" width="100%">
            <br><br>
            <a class="btn btn-sm btn-success" href="{{ url('/shop/game/'.$game->id.'/gift/create') }}">Добавить гифт!</a>
        </div>
    </div>

@endsection


@section('style')
    <style>
        button[disabled], html input[disabled] {
            cursor: no-drop;
        }
    </style>
@endsection