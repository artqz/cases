<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo $__env->yieldContent('title'); ?><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <?php echo $__env->yieldContent('style'); ?>
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
            <a class="navbar-brand" href="<?php echo e(url('/')); ?>" style="padding: 0">
                <img src="/images/logo_click.png" alt="Steamclicks" style="width: 40px; margin-top: 3px; margin-left: 15px; margin-right: 15px; padding: 0;">
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <?php echo $__env->make('layouts.menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                <?php if(Auth::guest()): ?>
                    <li><a href="<?php echo e(url('/login')); ?>">Войти</a></li>
                    <li><a href="<?php echo e(url('/register')); ?>">Регистрация</a></li>
                <?php else: ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="">
                            <div style="position: relative;">
                            <img src="https://secure.gravatar.com/avatar/<?php echo e(Auth::user()->email_hash); ?>?s=32&d=identicon" style="width:32px; height:32px; position:absolute; left:10px; border-radius:50%;">
                                <div class="user-name" style="padding-left: 50px; line-height: 1; color: #a04eb4;"><?php echo e(Auth::user()->name); ?> <span class="caret"></span></div>
                                <div class="user-clicks" style="padding-left: 50px; line-height: 1; font-size: 12px;">Клики: <?php echo e(Auth::user()->clicks); ?></div>
                            </div>    
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo e(url('/profile')); ?>">Профиль</a></li>
                            <li><a href="<?php echo e(url('/my-games')); ?>">Мои игры</a></li>
                            <li><a href="<?php echo e(url('/my-items')); ?>">Мои предметы</a>
                            <?php if(\Auth::id() == \Config::get('main.admin_id')): ?>
                            <li><a href="<?php echo e(url('admin')); ?>" style="color: red;">Панель управлления</a></li>
                            <?php endif; ?>
                            <li>
                                <a href="<?php echo e(url('/logout')); ?>"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    Выйти
                                </a>

                                <form id="logout-form" action="<?php echo e(url('/logout')); ?>" method="POST" style="display: none;">
                                    <?php echo e(csrf_field()); ?>

                                </form>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<?php if(!Request::is('/')): ?>
<div id="app" class="container">
    <div class="row">
        <div class="col-sm-9">
            <?php echo $__env->yieldContent('content'); ?>
        </div>

        <div class="col-sm-3">
            <?php echo $__env->yieldContent('sidebar'); ?>
        </div>
    </div>
</div>
<?php else: ?>
    <?php echo $__env->yieldContent('content'); ?>
<?php endif; ?>

<div class="footer">
    <div class="container">
        <footer class="bs-docs-footer">
            <p>© <?php echo e(date('Y')); ?> Steamclicks.ru - По всем вопросам писать на webmaster@steamclicks.ru</p>
        </footer>
    <div>
</div>

</body>
<script src="/js/app.js"></script>
<script src="/js/fuckadblock.js"></script>

<?php echo $__env->yieldContent('scripts'); ?>

<script src='https://www.google.com/recaptcha/api.js'></script>

<script>
    $('div.alert').not('.alert-important').delay(3000).slideUp(200);
</script>
</html>