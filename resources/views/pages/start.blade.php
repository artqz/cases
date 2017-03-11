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
        <br>
        <div class="container">
            <div class="col-sm-4">
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- 336_280_1_home_steamclicks -->
                <ins class="adsbygoogle"
                     style="display:inline-block;width:336px;height:280px"
                     data-ad-client="ca-pub-6809180877585246"
                     data-ad-slot="3807430925"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
            <div class="col-sm-4">
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- 336_280_2_home_steamclicks -->
                <ins class="adsbygoogle"
                     style="display:inline-block;width:336px;height:280px"
                     data-ad-client="ca-pub-6809180877585246"
                     data-ad-slot="3598621329"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
            <div class="col-sm-4">
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- 336_280_3_home_steamclicks -->
                <ins class="adsbygoogle"
                     style="display:inline-block;width:336px;height:280px"
                     data-ad-client="ca-pub-6809180877585246"
                     data-ad-slot="5075354525"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
        </div>
        <br>
    </div>
    <div id="what">
        @foreach($news->themes_news as $theme)
            {{ $theme->name }}
        @endforeach
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
                <iframe width="560" height="315" src="https://www.youtube.com/embed/ZM2a-d68EC0" frameborder="0" allowfullscreen></iframe>
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
    </style>
@endsection
