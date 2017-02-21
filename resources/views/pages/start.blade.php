@extends('app')

@section('content')
    <div id="information">
        <div class="container">
            <div class="col-sm-12 row">
                <img src="/images/logo_click2.png" alt="Steamclicks">
                <h1>Добро пожаловать на Steam Clicks!</h1>
                <ul>
                    <li class="col-sm-4">
                        <img src="/images/icons/click.png" alt="Click">
                        <h4>Получай клики каждые полчаса</h4>
                    </li>
                    <li class="col-sm-4">
                        <img src="/images/icons/friends.png" alt="Friends">
                        <h4>Приводи друзей и получай дополнительные клики</h4>
                    </li>
                    <li class="col-sm-4">
                        <img src="/images/icons/buy.png" alt="Buy">
                        <h4>Копи клики и покупай товары из нашего магазина</h4>
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
                <div>{{ $users }}</div>
                <br>
            </div>
            <div class="col-sm-4" style="text-align:center;">
                <br>
                <h4>Выдано монет</h4>
                <div>{{ $plays }}</div>
                <br>
            </div>
            <div class="col-sm-4" style="text-align:center;">
                <br>
                <h4>Постов на форуме</h4>
                <div>0</div>
                <br>
            </div>
        </div>
    </div>
    <div style="background-color:#5d2763; color: white;" id="features">
        <div class="container">
            <div class="col-sm-6">
                <div style="position: relative;">
                    <img src="/images/icons/stopwatch.png" style="width:70px; height:70px; position:absolute; top:20px; left:0px;" alt="stopwatch">
                </div>
                <div style="position: relative; margin-left:90px">
                    <h3>FREE BITCOINS EVERY HOUR</h3>
                    Try your luck every hour playing our simple game and you could win up to $200 in free bitcoins!
                </div>
            </div>
            <div class="col-sm-6">
                <div style="position: relative;">
                    <img src="/images/icons/rocket.png" style="width:70px; height:70px; position:absolute; top:20px; left:0px;" alt="stopwatch">
                </div>
                <div style="position: relative; margin-left:90px">
                    <h3>PROVABLY FAIR HI-LO GAME</h3>
                    Multiply your bitcoins playing a simple HI-LO game that is designed to be provably fair by using a combination of math and cryptography. Win big HI-LO jackpot prizes up to 1 bitcoin every time you play.
                </div>
            </div>
            <div class="col-sm-6">
                <div style="position: relative;">
                    <img src="/images/icons/trophy.png" style="width:70px; height:70px; position:absolute; top:20px; left:0px;" alt="stopwatch">
                </div>
                <div style="position: relative; margin-left:90px">
                    <h3>FREE WEEKLY LOTTERY</h3>
                    Win big prizes with our weekly lottery for which you get free tickets every time you or someone referred by you plays the free bitcoin game.
                </div>
            </div>
            <div class="col-sm-6">
                <div style="position: relative;">
                    <img src="/images/icons/diagram.png" style="width:70px; height:70px; position:absolute; top:20px; left:0px;" alt="stopwatch">
                </div>
                <div style="position: relative; margin-left:90px">
                    <h3>GENEROUS REFERRAL PROGRAM</h3>
                    Refer your friends after signing up, and get 50% of whatever they win in addition to getting free lottery tickets every time they play.
                </div>
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
                <iframe width="720" height="405" src="https://www.youtube.com/embed/Q2YHhLkOO9g" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <style>
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
