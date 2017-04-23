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
                <div>{{ round($stats[0]['value']) }}</div>
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
                <div>{{ round($stats[3]['value']) }}</div>
                <br>
            </div>
        </div>
    </div>
    <div style="background-color:#5d2763; color: white;" id="features">
        <br>
        <div class="container">
            <div class="col-sm-4">
                <script type='text/javascript'>(function() {
                        /* Optional settings (these lines can be removed): */
                        subID = "";  // - local banner key;
                        injectTo = "";  // - #id of html element (ex., "top-banner").
                        /* End settings block */

                        if(injectTo=="")injectTo="admitad_shuffle"+subID+Math.round(Math.random()*100000000);
                        if(subID=='')subid_block=''; else subid_block='subid/'+subID+'/';
                        document.write('<div id="'+injectTo+'"></div>');
                        var s = document.createElement('script');
                        s.type = 'text/javascript'; s.async = true;
                        s.src = 'https://ad.admitad.com/shuffle/feccab2e4e/'+subid_block+'?inject_to='+injectTo;
                        var x = document.getElementsByTagName('script')[0];
                        x.parentNode.insertBefore(s, x);
                    })();</script>
            </div>
            <div class="col-sm-4">
                <iframe data-aa='494990' src='//ad.a-ads.com/494990?size=300x250' scrolling='no' style='width:300px; height:250px; border:0px; padding:0;overflow:hidden' allowtransparency='true'></iframe>
            </div>
            <div class="col-sm-4">
                <!-- Yandex.RTB R-A-217702-5 -->
                <div id="yandex_rtb_R-A-217702-5"></div>
                <script type="text/javascript">
                    (function(w, d, n, s, t) {
                        w[n] = w[n] || [];
                        w[n].push(function() {
                            Ya.Context.AdvManager.render({
                                blockId: "R-A-217702-5",
                                renderTo: "yandex_rtb_R-A-217702-5",
                                horizontalAlign: false,
                                async: true
                            });
                        });
                        t = d.getElementsByTagName("script")[0];
                        s = d.createElement("script");
                        s.type = "text/javascript";
                        s.src = "//an.yandex.ru/system/context.js";
                        s.async = true;
                        t.parentNode.insertBefore(s, t);
                    })(this, this.document, "yandexContextAsyncCallbacks");
                </script>
            </div>
        </div>
        <br>
    </div>
    @if($news)
    <div id="news">
        <div class="container">
            <div class="col-sm-12 row">
            <h2>Последние новости Steam Clicks</h2>
                <div class="news-list">
                @foreach($news->themes_news as $theme)
                    <div class="col-sm-4">
                        <div class="news-item">
                            <div class="news-name">{{ $theme->name }}</div>
                            <div class="news-date">{{ $theme->created_at->diffForHumans() }}</div>
                            <div class="news-text">{{ mb_strimwidth($theme->posts[0]->text, 0, 200, '...') }}</div>
                            <div class="news-link pull-right"><a class="btn btn-xs btn-default" href="{{ url('discuss/channels/'.$news->slug.'/'.$theme->slug) }}">Подробнее</a></div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif
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
