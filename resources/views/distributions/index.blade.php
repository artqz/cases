@extends('app')

@section('title', 'Раздачи - ')

@section('content')
    <div>
        @include('layouts.flash')
        {!! Breadcrumbs::render('discuss') !!}
        <h1>Раздачи</h1>
        <div class="distributions-list">
            @foreach($distributions as $distribution)
                @if($distribution->type == 1)
                <div class="col-md-12">
                    <div class="distribution-card row">
                        <div class="distribution-image"><img src="{{ $distribution->game_image }}" alt="Раздача {{ $distribution->game_name }}"></div>
                        <div style="display: inline-block; vertical-align: middle;">
                            <div class="distribution-name">Раздача {{ $distribution->game_name }}</div>
                            <div class="distribution-price"><span class="price">{{ $distribution->price }}</span></div>
                            <div class="distribution-players"><i class="fa fa-users" aria-hidden="true"></i> {{ $distribution->joined_players }}/{{ $distribution->players }}</div>
                            <div class="distribution-comments"><i class="fa fa-comments-o" aria-hidden="true"></i> 1</div>
                            <div class="distribution-steam"><a href="http://store.steampowered.com/app/{{ $distribution->game_id }}/"><i class="fa fa-steam" aria-hidden="true"></i></a></div>
                        </div>
                        <div class="distribution-show">Подробнее</div>
                    </div>
                </div>
                @endif
            @endforeach
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