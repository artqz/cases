@extends('app')

@section('title', 'Купить кристаллы - ')

@section('content')
    <div>
        @include('layouts.flash')
        <div class="crystals-list row">
            <div class="col-sm-4">
                <a href="{{ url('donate/buy/1') }}" class="crystal-card">
                   <img src="{{ url('images/icons/clickcrystal.png') }}" alt="Кристалл">
                    <div class="crystals">Купить 1 кристалл</div>
                    <div class="ruble">За 15 Рублей <span class="economy">экономия 0 рублей</span></div>
                </a>
            </div>
            <div class="col-sm-4">
                <a href="{{ url('donate/buy/5') }}" class="crystal-card">
                    <img src="{{ url('images/icons/clickcrystal.png') }}" alt="Кристалл">
                    <div class="crystals">Купить 5 кристаллов</div>
                    <div class="ruble">За 70 Рублей <span class="economy">экономия 5 рублей</span></div>
                </a>
            </div>
            <div class="col-sm-4">
                <a href="{{ url('donate/buy/10') }}" class="crystal-card">
                    <img src="{{ url('images/icons/clickcrystal.png') }}" alt="Кристалл">
                    <div class="crystals">Купить 10 кристаллов</div>
                    <div class="ruble">За 100 Рублей <span class="economy">экономия 50 рублей</span></div>
                </a>
            </div>
        </div>
    </div>
@endsection

@section('sidebar')
    @widget('WidgetChat')

    @include('widgets.reklama')

    @include('widgets.vk')

@endsection