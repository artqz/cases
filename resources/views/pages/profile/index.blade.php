@extends('app')

@section('title', 'Профиль - ')

@section('content')
    @include('layouts.flash')
    <h1>Профиль</h1>

    <h3>Реферальная программа</h3>
    <div class="row">
        <div class="col-sm-12">
            <div class="ref-link">https://steamclicks.ru/r/{{ Auth::id() }}</div>
        </div>
    </div>
    <p>По вашей ссылке зарегистрировалось {{ $referral_count }} чел., которые принесли вам {{ $referral_clicks }} Клик.</p>
    <br>
    <h3>Подтверждение аккаунта</h3>
    <p>Для получения доступа ко всем функциям сайта Вам необходимо подключить аккаунт Steam, а также подтвердить адрес электронной почты.</p>
    <div class="row">
        <div class="col-sm-6">
            @if(Auth::user()->steamid)
                <div class="btn-steam active"><i class="fa fa-steam" aria-hidden="true"></i> Аккаунт Steam успешно подключен!</div>
            @else
                <a class="btn-steam" href="{{ url('profile/join-steam') }}"><i class="fa fa-steam" aria-hidden="true"></i> Подключить аккаунт Steam</a>
            @endif
        </div>
        <div class="col-sm-6">
            @if(Auth::user()->confirm_email)
                <div class="btn-mail active"><i class="fa fa-envelope" aria-hidden="true"></i> Электронная почта подтверждена!</div>
            @else
                <a class="btn-mail" href="{{ url('profile/check-email') }}"><i class="fa fa-envelope" aria-hidden="true"></i>  Подтвердить электронную почту</a>
            @endif
        </div>
    </div>
    <br>
    <h3>Выдача предметов</h3>
    <p>Для более оперативной выдачи предметов укажите свою <a href="#">ссылку для обмена</a>.</p>
    <div class="row">
        <div class="col-sm-9">
            @if(Auth::user()->tradeoffer)
                <div class="trade-link">{{ Auth::user()->tradeoffer }}</div>
            @else()
                <div class="trade-link">Отсутсвует</div>
            @endif
        </div>
        <div class="col-sm-3"><a class="btn-steam" href="{{ url('profile/edit-tradeoffer') }}"><i class="fa fa-steam" aria-hidden="true"></i> Изменить</a></div>
    </div>
    @if(Auth::user()->steamid)
    <h3>Обновить информацию Steam-аккаунта</h3>
    <div class="row">
        <div class="col-sm-12">
            <form role="form" method="POST" action="{{ url('profile/update-steam') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}"></div>
                </div>
                <br>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Обновить</button>
                </div>
            </form>
        </div>
    </div>
    @endif
@endsection