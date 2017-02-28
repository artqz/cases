<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title'){{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    @yield('style')

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
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="position: relative; padding-left: 50px;">
                            <img src="https://secure.gravatar.com/avatar/{{ Auth::user()->email_hash }}?s=32&d=identicon" style="width:32px; height:32px; position:absolute; top:10px; left:10px; border-radius:50%;">
                            {{ Auth::user()->email }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/profile') }}">Профиль</a></li>
                            <li><a href="{{ url('/my-games') }}">Мои игры</a></li>
                            <li><a href="{{ url('/my-items') }}">Мои предметы</a></li>
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
<div class="container">
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

</body>
<script src="/js/app.js"></script>
<script src="/js/fuckadblock.js"></script>

@yield('scripts')

<script src='https://www.google.com/recaptcha/api.js'></script>

<script>
    $('div.alert').not('.alert-important').delay(3000).slideUp(200);
</script>
</html>