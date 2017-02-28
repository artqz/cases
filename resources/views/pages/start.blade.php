@extends('app')

@section('content')
    <div id="information">
        <div class="container">
            <div class="col-sm-12 row">
                <img src="/images/logo_click2.png" alt="Steamclicks">
                <h1>Добро пожаловать на Steam Clicks!</h1>
                <ul>
                    <li class="col-sm-4">
                        <a href="{{ url ('faucet') }}">
                            <img src="/images/icons/click.png" alt="Click">
                            <h4>Получай клики каждые полчаса</h4>
                        </a>
                    </li>
                    <li class="col-sm-4">
                        <a href="{{ url ('referral') }}">
                            <img src="/images/icons/friends.png" alt="Friends">
                            <h4>Приводи друзей и получай дополнительные клики</h4>
                        </a>
                    </li>
                    <li class="col-sm-4">
                        <a href="{{ url ('shop') }}">
                            <img src="/images/icons/buy.png" alt="Buy">
                            <h4>Копи клики и покупай товары из нашего магазина</h4>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div style="background-color:white; border-top: 1px solid #e3e3e3;" id="stats">
        <div class="container">
            <div class="col-sm-4" style="text-align:center;">
                <br>
                <h4>Зарегистрировано пользователей</h4>
                <div>{{ $stats[0]['value'] }}</div>
                <br>
            </div>
            <div class="col-sm-4" style="text-align:center;">
                <br>
                <h4>Выдано кликов</h4>
                <div>{{ $stats[4]['value'] }}</div>
                <br>
            </div>
            <div class="col-sm-4" style="text-align:center;">
                <br>
                <h4>Постов на форуме</h4>
                <div>{{ $stats[3]['value'] }}</div>
                <br>
            </div>
        </div>
    </div>
    <div style="background-color:#5d2763; color: white;" id="features">
        <div class="container">
            <div class="col-sm-4">
                Реклама
            </div>
            <div class="col-sm-4">
                Реклама
            </div>
            <div class="col-sm-4">
                Реклама
            </div>
        </div>
        <br>
    </div>
    <div id="what">
        <div class="container">
            <h2 style="text-align:center;">Что такое Steam clicks?</h2>
            <span>
               <h4>Первый в своем роде проект, по бесплатной раздаче игр и продуктов сообщества Steam.</h4>
                <p>Иногда хочется купить игру со Steam или скины, предметы для популярных игр в которые уже играешь (таких как Dota 2, Counter-Strike), но не хочется за них платить свои собственные деньги?</p>

                <p>Специально для вас мы разработали наш сервис, на котором желаемые покупки на Steam можно получить совершенно бесплатно!</p>

                <p>Секрет очень прост - зарабатывай клики на нашем сайте и обменивай их на любимые игры, либо предметы из игр.</p>

                <p>Мы покупаем игры и комплектующие, публикуем количество данных позиций в наличии. Они становятся доступными каждому участнику.</p>

                <p>Вы зарабатываете клики, и набрав необходимое количество можете смело забирать, то что нравится! Подарок отправится прямиком на тот адрес электронной почты, который вы укажете.</p>

                <p>Будьте внимательны, если товар находится в одном экземпляре в наличии, значит кто-то может его забрать раньше чем Вы =)</p>

                <p>Поэтому не стоит думать что, ассортимент будет всегда одинаков. Мы постоянно обновляем позиции, с учетом вашего спроса и их актуальности.</p>

                <p>Все пожелания по добавлению того, или иного товара со Steam можете писать на нашем форуме</p>


            </span>
            <br><br>
            <div class="row" style="text-align:center;">
                Наше видео!
            </div>
        </div>
    </div>
@endsection

@section('style')
    <style>
        ul li a {
            text-decoration: none;
            color: #fff;
        }
        ul li a:hover {
             text-decoration: none;
             color: #fff;
        }
        ul li a:active {
            text-decoration: none;
            color: #fff;
        }
        #information {
            background: url("/images/bg/dota.jpg");
            margin-top: -22px;
            background-size: cover;
            background-position: top;
            background-attachment: fixed;
            background-repeat: no-repeat;
            position: relative;
            color: #fff;
            text-align: center;
            padding: 25px;
        }
        #information:before {
            content: '';
            background: rgba(125, 28, 136, 0.52);
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }
        #information ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
    </style>
@endsection
