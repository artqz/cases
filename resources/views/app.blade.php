<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="propeller" content="edeeb3399f1f35fc792f5422a805ac0d" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')
    <title>@yield('title'){{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ elixir("css/app.css") }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    @yield('style')
    <style>
        .footer {
            line-height: 4;
            border-top: 1px solid #ebebeb;
            margin-top: 50px;
        }
    </style>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter43174499 = new Ya.Metrika({
                        id:43174499,
                        clickmap:true,
                        trackLinks:true,
                        accurateTrackBounce:true
                    });
                } catch(e) { }
            });

            var n = d.getElementsByTagName("script")[0],
                    s = d.createElement("script"),
                    f = function () { n.parentNode.insertBefore(s, n); };
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://mc.yandex.ru/metrika/watch.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else { f(); }
        })(document, window, "yandex_metrika_callbacks");
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/43174499" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>

<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}" style="padding: 0">
                <img src="/images/logo_click.png" alt="Steamclicks" style="width: 40px; margin-top: 3px; margin-left: 15px; margin-right: 15px; padding: 0;">
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                @include('layouts.menu')
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Войти</a></li>
                    <li><a href="{{ url('/register') }}">Регистрация</a></li>
                @else
                    <li role="presentation" class="dropdown events">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            @if(\App\Event::where('user_id', Auth::id())->where('status', 0)->count() >= 1)
                                <i class="fa fa-bell" aria-hidden="true" style="color: gold;"></i>
                            @else
                                <i class="fa fa-bell-o" aria-hidden="true"></i>
                            @endif
                        </a>
                        <ul class="dropdown-menu events" id="menu2" aria-labelledby="drop6">
                            @widget('events')
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="">
                            <div style="position: relative;">
                                <img src="{{ avatar(Auth::user()->email_hash, Auth::user()->steam_avatar) }}" style="width:32px; height:32px; position:absolute; left:10px; border-radius:50%;">
                                <div class="user-name" style="padding-left: 50px; line-height: 1; color: #a04eb4;">{{ Auth::user()->name }} <span class="caret"></span></div>
                                <div class="user-clicks" style="padding-left: 50px; line-height: 1; font-size: 12px;">Клики: {{Auth::user()->clicks}}</div>
                            </div>    
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/profile') }}">Профиль</a></li>
                            <li><a href="{{ url('/my-games') }}">Мои игры</a></li>
                            <li><a href="{{ url('/my-items') }}">Мои предметы</a>
                            @if (\Auth::id() == \Config::get('main.admin_id'))
                            <li><a href="{{ url('admin') }}" style="color: red;">Панель управлления</a></li>
                            @endif
                            <li>
                                <a href="{{ url('/logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    Выйти
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
@if(!Request::is('/'))
<div id="app" class="container">
    <div class="row">
        <div class="col-sm-9">
            @yield('content')
        </div>

        <div class="col-sm-3">
            @yield('sidebar')
        </div>
    </div>
</div>
@else
    @yield('content')
@endif

<div class="footer">
    <div class="container">
        <footer>
            <p>© {{ date('Y') }} Steamclicks.ru - Powered by <a target="_blank" rel="nofollow" href="http://steampowered.com">Steam</a>.</p>
            <p>По всем вопросам писать на webmaster@steamclicks.ru</p>
        </footer>
    <div>
</div>

</body>
<script src="/js/app.js"></script>
<script src="/js/fuckadblock.js"></script>

@yield('scripts')

<script src='https://www.google.com/recaptcha/api.js'></script>

<script>
    $('div.alert').not('.alert-important').delay(3000).slideUp(200);
</script>
</html>