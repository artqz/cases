@extends('app')

@section('title', 'Получить клики - ')

@section('meta')
    <meta property="og:type" content="exchange" />
    <meta property="og:title" content="Получить клики" />
    <meta property="og:description" content="Не трать время на капчу, меня кристаллы на клики!" />
    <meta property="og:url" content="{{ url('exchange') }}" />
    <meta property="og:image" content="{{ url('images/icons/clickcoin.png') }}" />
@endsection

@section('content')
    <div>
        @include('layouts.flash')
        {!! Breadcrumbs::render('exchange') !!}
        <h1>Получить клики</h1>
        <div class="clicks-list row">
            <div class="col-sm-4">
                <a href="{{ url('exchange/get/100') }}" class="click-card">
                   <img src="{{ url('images/icons/clickcoin.png') }}" alt="Клик">
                    <div class="clicks">Получить 100 кликов</div>
                    <div class="crystals">За 1 Кристалл</div>
                </a>
            </div>
            <div class="col-sm-4">
                <a href="{{ url('exchange/get/500') }}" class="click-card">
                    <img src="{{ url('images/icons/clickcoin.png') }}" alt="Клик">
                    <div class="clicks">Получить 500 кликов</div>
                    <div class="crystals">За 5 Кристаллов</div>
                </a>
            </div>
            <div class="col-sm-4">
                <a href="{{ url('exchange/get/1000') }}" class="click-card">
                    <img src="{{ url('images/icons/clickcoin.png') }}" alt="Клик">
                    <div class="clicks">Получить 1000 кликов</div>
                    <div class="crystals">За 10 Кристаллов</div>
                </a>
            </div>
        </div>
    </div>
@endsection

@section('sidebar')
    @include('widgets.buy')

    @include('widgets.vk')

    @widget('WidgetChat')

    @include('widgets.reklama')

@endsection