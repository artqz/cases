@extends('app')

@section('content')
    <h1>Профиль

    <h3>Реферальная программа</h3>
    <p>Ваша ссылка - http://steamclicks.ru/r/{{ Auth::id() }}</p>
    <p>По вашей ссылке зарегистрировалось {{ $referral_count }} чел., которые принесли вам {{ $referral_clicks }} Клик.</p>
@endsection