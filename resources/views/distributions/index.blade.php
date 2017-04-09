@extends('app')

@section('title', 'Раздачи - ')

@section('content')
    <div>
        @include('layouts.flash')
        {!! Breadcrumbs::render('distributions') !!}
        <h1>Раздачи</h1>
        <div class="row categories">
                <div class="col-sm-3 col-md-3">
                    <a class="category" href="{{ url('distributions/c/active') }}">
                        <img class="category-icon" src="{{ url('images/icons/clickcrystal.png') }}">
                        <span class="category-name">Премиум</span>
                    </a>
                </div>
        </div>
        <div class="distributions-list">
            @foreach($distributions as $distribution)
                @if($distribution->type == 1 OR $distribution->type == 2)
                <div class="col-md-12">
                    <div class="distribution-card row" style="{{ (!$distribution->user_winner_id) ? '' : 'background-color: #f1f1f1;' }}">
                        <div class="distribution-image"><img src="{{ $distribution->data_image }}" alt="Раздача {{ $distribution->data_name }}"></div>
                        <div style="display: inline-block; vertical-align: middle;">
                            <div class="distribution-name">Раздача {{ $distribution->data_name }}</div>
                            <div class="distribution-players"><i class="fa fa-users" aria-hidden="true"></i> {{ $distribution->joined_players }}/{{ $distribution->players }}</div>
                            <div class="distribution-user"><a href="{{ url('users/'.$distribution->user->id) }}"><img src="{{ avatar($distribution->user->email_hash, $distribution->user->steam_avatar) }}">{{ $distribution->user->name }}</a></div>
                        </div>
                        <div class="distribution-show"><a href="{{ url('distributions/'.$distribution->slug) }}">Подробнее</a></div>
                        @if(!$distribution->user_winner_id)
                            @if(!count($distribution->players_list->where('user_id', Auth::id())))
                                <div class="distribution-join"><a href="{{ url('distributions/'.$distribution->slug.'/join') }}">Вступить <span class="price">{{ $distribution->price }}</span></a></div>
                            @endif
                        @endif
                    </div>
                </div>
                @endif
            @endforeach
        </div>

    </div>
@endsection

@section('sidebar')
    @if(Auth::id())
        <div class="panel panel-default">
            <div class="panel-body">
                @if(Auth::user()->isTrader == 0)
                    Для того, чтобы создавать свои раздачи необходимо приобрести сертификат торговца за <div class="price" style="display: inline-block;">{{ Config::get('main.price_cert') }}</div>
                    <div class="clearfix"></div>
                    <br>
                    <a class="btn btn-sm btn-warning" href="{{ url('distributions/buy-cert') }}">Купить сертификат</a>
                @else
                    <div>
                        <a class="btn btn-sm btn-success" href="{{ url('distributions/create') }}">Создать раздачу</a>
                    </div>
                @endif
            </div>
        </div>
    @endif

    @widget('WidgetChat')

    @include('widgets.reklama')

@endsection