@extends('app')

@section('title', 'Купить кристаллы - ')

@section('content')
    <div>
        @include('layouts.flash')
        <div class="crystals-list row">
            <div class="col-sm-4">
                <div class="crystal-card">
                    <a href="{{ url('donate/buy/1') }}">
                        <img src="{{ url('images/icons/clickcrystal.png') }}" alt="Кристалл">
                        <div>Купить 1 кристалл</div>
                    </a>
                </div>
            </div>
            <div class="col-sm-4">
                <div  class="crystal-card">
                    <a href="{{ url('donate/buy/5') }}">
                        <img src="{{ url('images/icons/clickcrystal.png') }}" alt="Кристалл">
                        <div>Купить 5 кристаллов</div>
                    </a>
                </div>
            </div>
            <div class="col-sm-4">
                <div  class="crystal-card">
                    <a href="{{ url('donate/buy/10') }}">
                        <img src="{{ url('images/icons/clickcrystal.png') }}" alt="Кристалл">
                        <div>Купить 10 кристаллов</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('sidebar')
    @widget('WidgetChat')

    @include('widgets.reklama')

    @include('widgets.vk')

@endsection