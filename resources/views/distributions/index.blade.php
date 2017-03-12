@extends('app')

@section('title', 'Раздачи - ')

@section('content')
    <div>
        @include('layouts.flash')
        {!! Breadcrumbs::render('discuss') !!}
        <h1>Раздачи</h1>
        <div class="distributions-list">
            @foreach($distributions as $distribution)
                <div class="col-md-12">
                    <div class="distribution-card row">
                        <div class="col-md-4">
                            <div class="distribution-name">Раздача {{ $distribution->game_name }}</div>
                            <div class="distribution-image"><img src="{{ $distribution->game_image }}" alt="Раздача {{ $distribution->game_name }}"></div>
                            <div class="distribution-user"><img src="https://secure.gravatar.com/avatar/{{ $distribution->user->email_hash }}?s=32&d=identicon"> {{ $distribution->user->name }}</div>
                            <div class="distribution-price">Стоимость участия: <span class="price">{{ $distribution->price }}</span></div>
                        </div>
                        <div class="col-md-8">

                            <div class="distribution-players">Участников: {{ $distribution->players_count() }} из {{ $distribution->players }}</div>

                            <div class="row">
                            @foreach($distribution->players_list as $player)
                                <div class="col-md-4">
                                    <div class="player-name">
                                        <img src="https://secure.gravatar.com/avatar/{{ $player->user->email_hash }}?s=32&d=identicon"> {{ $player->user->name }}
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        </div>
                        <div class="col-md-12">
                            <a class="buy" href="{{ url('distributions/'.$distribution->id.'/join') }}">Участвовать</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection

@section('sidebar')
    <div class="panel panel-default">
        <div class="panel-body">
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