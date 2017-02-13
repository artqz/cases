@extends('app')

@section('content')
        {!! Breadcrumbs::render('game', $game->id) !!}


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