@extends('app')

@section('title', 'Раздачи - ')

@section('content')
    <div>
        @include('layouts.flash')
        {!! Breadcrumbs::render('discuss') !!}
        <h1>Раздача {{ $distribution->game_name }}</h1>

        <div>
            <img src="{{ $distribution->game_image }}" alt="{{ $distribution->game_name }}">
            <div class="distribution-players"><i class="fa fa-users" aria-hidden="true"></i> Участников {{ $distribution->joined_players }} из {{ $distribution->players }}</div>
        </div>

    </div>
@endsection

@section('sidebar')
    <div class="panel panel-default">
        <div class="panel-body">
            @if(Auth::user()->isTrader == 0)
            Для того, чтобы создавать свои раздачи необходимо преобрести сертификат торговца за <div class="price" style="display: inline-block;">{{ Config::get('main.price_cert') }}</div>
            <div class="clearfix"></div>
            <br>
            <a class="btn btn-sm btn-warning" href="{{ url('distributions/buy-cert') }}">Купить сертификат</a>
            <hr>
            @endif
            <div>Тут можно создать раздачу</div><br>
            <a class="btn btn-sm btn-success" href="{{ url('distributions/create') }}">Создать раздачу</a>
        </div>
    </div>

    @widget('WidgetChat')

    @include('widgets.reklama')

    @widget('WidgetTopClickers')

    @widget('WidgetLastPosts')

@endsection


@section('style')
    <style>
        button[disabled], html input[disabled] {
            cursor: no-drop;
        }
        .channels-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .channel-item {
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