@extends('app')

@section('title', 'Профиль - ')

@section('content')
    @include('layouts.flash')
    <h1>Профиль</h1>

    <h3>Реферальная программа</h3>
    <p>Ваша ссылка - https://steamclicks.ru/r/{{ Auth::id() }}</p>
    <p>По вашей ссылке зарегистрировалось {{ $referral_count }} чел., которые принесли вам {{ $referral_clicks }} Клик.</p>
    <br>
    <br>
    <p><strong>Ваша ссылка для обмена:</strong>
        @if(Auth::user()->tradeoffer)
            {{ Auth::user()->tradeoffer }}
            <br>
            <a class="btn btn-default btn-xs" href="{{ url('profile/edit-tradeoffer') }}">Изменить ссылку на обмен</a>
        @else()
            Отсутсвует.
            <br>
            <a class="btn btn-default btn-xs" href="{{ url('profile/edit-tradeoffer') }}">Добавить ссылку на обмен</a>
        @endif
    </p>
@endsection