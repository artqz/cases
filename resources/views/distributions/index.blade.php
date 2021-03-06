@extends('app')

@section('title', 'Раздачи - ')

@section('content')
    <div>
        @include('layouts.flash')
        {!! Breadcrumbs::render('distributions') !!}
        <h1>Раздачи</h1>
        <br>
        <div style="text-align: center"><iframe data-aa='499195' src='//ad.a-ads.com/499195?size=728x90' scrolling='no' style='width:728px; height:90px; border:0px; padding:0;overflow:hidden' allowtransparency='true'></iframe></div>
        <br>
        <div class="row categories">
            <div class="col-sm-3 col-md-3">
                <a class="category {{ Request::is('distributions/c/premium') ? 'active' : '' }}" href="{{ url('distributions/c/premium') }}">
                    <img class="category-icon" src="{{ url('images/icons/clickcrystal.png') }}" alt="Премиум раздачи">
                    <span class="category-name">Премиум</span>
                </a>
            </div>
            <div class="col-sm-3 col-md-3">
                <a class="category {{ Request::is('distributions/c/active') ? 'active' : '' }}" href="{{ url('distributions/c/active') }}">
                    <div class="category-icon">
                        <img src="{{ url('images/icons/clickcoin.png') }}" alt="Активные раздачи">
                    </div>
                    <span class="category-name">Активные</span>
                </a>
            </div>
            <div class="col-sm-3 col-md-3">
                <a class="category {{ Request::is('distributions/c/passed') ? 'active' : '' }}" href="{{ url('distributions/c/passed') }}">
                    <div class="category-icon">
                        <div class="passed"></div>
                        <img src="{{ url('images/icons/clickcoin.png') }}" alt="Прошедшие раздачи">
                    </div>
                    <span class="category-name">Прошедшие</span>
                </a>
            </div>
        </div>
        <div class="distributions-list">
            @foreach($distributions as $distribution)
                @if($distribution->type == 1 OR $distribution->type == 2)
                <div class="col-md-12">
                    <div class="distribution-card row" style="{{ ($distribution->status != 0) ? 'background-color: #f1f1f1;' : '' }}">
                        <div class="distribution-image"><img src="{{ $distribution->data_image }}" alt="Раздача {{ $distribution->data_name }}"></div>
                        <div style="display: inline-block; vertical-align: middle;">
                            <div class="distribution-name">Раздача {{ $distribution->data_name }}</div>
                            <div class="distribution-players"><i class="fa fa-users" aria-hidden="true"></i> {{ $distribution->joined_players }}/{{ $distribution->players }}</div>
                            <div class="distribution-user"><a href="{{ url('users/'.$distribution->user->id) }}"><img src="{{ avatar($distribution->user->email_hash, $distribution->user->steam_avatar) }}">{{ $distribution->user->name }}</a></div>
                        </div>
                        <div class="distribution-show"><a href="{{ url('distributions/'.$distribution->slug) }}">Подробнее</a></div>
                        @if($distribution->status == 0)
                            @if($distribution->user_id != Auth::id())
                                @if(!$distribution->user_winner_id)
                                    @if(!count($distribution->players_list->where('user_id', Auth::id())))
                                        <div class="distribution-join"><a href="{{ url('distributions/'.$distribution->slug.'/join') }}">Вступить <span class="price {{ ($distribution->level == 2) ? 'crystal' : '' }}">{{ $distribution->price }}</span></a></div>
                                    @endif
                                @endif
                            @endif
                        @endif
                    </div>
                </div>
                @endif
            @endforeach
        </div>
        <div>{{$distributions->links()}}</div>
    </div>
@endsection

@section('sidebar')
    @include('widgets.buy')

    @if(Auth::id())
        <div class="panel panel-default">
            <div class="panel-body">
                @if(Auth::user()->isTrader == 0)
                    Для того, чтобы создавать свои раздачи необходимо приобрести сертификат торговца за <span class="price">{{ Config::get('main.price_cert') }}</span> либо за <span class="price crystal">{{ Config::get('main.price_cert_crystals') }}</span>
                    <div class="clearfix"></div>
                    <br>
                    <a class="join buy cert" href="{{ url('distributions/buy-cert') }}">Купить сертификат <span class="price">{{ Config::get('main.price_cert') }}</span></a>
                    <br>
                    <a class="join buy cert" href="{{ url('distributions/buy-cert-crystals') }}">Купить сертификат <span class="price crystal">{{ Config::get('main.price_cert_crystals') }}</span></a>
                @else
                    <div>
                        <a class="btn btn-sm btn-success" href="{{ url('distributions/create') }}">Создать раздачу</a>
                    </div>
                @endif
            </div>
        </div>
    @endif

    @widget('WidgetChat')

    @include('widgets.vk')

    @include('widgets.reklama')

@endsection