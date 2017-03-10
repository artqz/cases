@extends('app')

@section('title', 'Бонусы - ')

@section('content')
    {!! Breadcrumbs::render('referral') !!}
    <h1>Реферальная система</h1>
    <p>Мы предлагаем уникальную реферальную систему с помощью которой заработать необходимое количество кликов возможно гораздо легче и быстрее.</p>
    <p>Что она из себя представляет?
    Наверное каждый слышал поговорку: "Один в поле - не воин!". Так и здесь, конечно, можно зарабатывать и одному, а можно пригласить друзей и  тем самым, ускорить процесс  получения кликов в несколько раз. Ведь с каждого приглашенного друга вы будете получать бонусом - четверть его заработка!
    </p>
    <p>С нами любимые <a href="{{ url('shop') }}">игры и товары из Steam</a> - становятся доступными каждому!</p>

    <h2>Как это работает?</h2>
    <p>В своем профиле вы копируюте свою реферальную ссылку типа https://steamclicks.ru/r/777, после чего делитесь этой ссылкой с друзьями в социальных сетях, либо на различных игровых форумах.
    После чего любой зарегистрированный по вашей ссылке будет приносить вам с каждого своего клика 20%. Все просто больше рефералов - больше кликов!</p>

@endsection

@section('sidebar')
    @widget('WidgetChat')

    @include('widgets.reklama')

    @widget('WidgetTopClickers')

    @widget('WidgetLastPosts')

@endsection