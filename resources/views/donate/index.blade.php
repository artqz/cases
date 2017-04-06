@extends('app')

@section('title', 'Купить кристаллы - ')

@section('meta')
    <meta property="og:type" content="distribution" />
    <meta property="og:title" content="Купить кристаллы" />
    <meta property="og:description" content="Покупай кристаллы и участвуй в премиум раздачах!" />
    <meta property="og:url" content="{{ url('donate') }}" />
    <meta property="og:image" content="{{ url('images/icons/clickcrystal.png') }}" />
@endsection

@section('content')
    <div>
        @include('layouts.flash')
        {!! Breadcrumbs::render('donate') !!}
        <h1>Купить кристаллы</h1>
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
                    <div class="ruble">За 110 Рублей <span class="economy">экономия 40 рублей</span></div>
                </a>
            </div>
        </div>
        <h4>Что такое Кристаллы?</h4>
        <p><b>Кристаллы</b> - специальная внутренняя валюта сайта, использующаяся для участия в элитных раздачах от администрации сайта.</p>
        <p>Кристаллы можно получить, только купив их, в нашем магазине. Имеется возможность обменять Кристаллы на Клики. 1 Кристалл = 100 Кликов.</p>
        <h4>Зачем нужны Кристаллы?</h4>
        <p>Так как Кристаллы можно менять на Клики, то это очень ценный ресурс в рамках нашего проекта. Клики бывают нужны срочно по разным причинам: купить сертификат Торговца, скорее забрать предмет из магазина на который кто-то еще претендует и т.д., с дополнительными Кристаллами на счету всегда будет легче активным пользователям сайта. В дальнейшем, участники смогут сами создавать раздачи за Кристаллы и начнут зарабатывать их без вложений каких либо денег. Участники элитных раздач также имеют свою выгоду: участвуя в раздаче игр или предметов стоимостью от 500 рублей, стоимость входа в раздачу будет составлять от 1 Кристалла (в зависимости от условий раздачи), выиграв игру/предмет таким способом, покупатель потратит всего лишь 15 рублей вместо полной стоимости игры.</p>
    </div>
@endsection

@section('sidebar')
    @include('widgets.vk')

    @widget('WidgetChat')

    @include('widgets.reklama')

@endsection