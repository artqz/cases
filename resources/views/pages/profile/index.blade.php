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
        Для получения доступа ко всем функциям сайта Вам необходимо подключить аккаунт Steam, а также подтвердить адрес электронной почты.
    <div class="row">
        <div class="col-sm-6">
            @if(Auth::user()->steamid)
                <div class="btn-steam active"><i class="fa fa-steam" aria-hidden="true"></i> Аккаунт Steam успешно подключен!</div>
            @else
                <a class="btn-steam" href="{{ url('profile/join-steam') }}"><i class="fa fa-steam" aria-hidden="true"></i> Подключить аккаунт Steam</a>
            @endif
        </div>
        <div class="col-sm-6">
            <a class="btn-mail" href="{{ url('profile/check-email') }}"><i class="fa fa-envelope" aria-hidden="true"></i>  Подтвердить электронную почту</a>
        </div>
    </div>
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