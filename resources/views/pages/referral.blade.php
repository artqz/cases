@extends('app')

@section('title', 'Бонусы - ')

@section('content')
    {!! Breadcrumbs::render('referral') !!}

    <h1>Бонусы</h1>

    <h4>Реферальная система</h4>
    <p>
    Каждый "Клик" вашего друга, принесет Вам бонусные "Клики".
    Подробнее о эффективности реферальной системы на живом примере:
    За первую неделю существования нашего сайта, пользователь со специфическим псевдонимом "Мамин парень" пригласил 62 человека и число приглашенных продолжает расти. Каждый реферал, который подтвердил свой аккаунт через Steam и E-mail, кликая один раз приносит от 0,2 до 0,6 Клика (в зависимости от количества Кликов, которое досталось приглашенному - от 1 до 3). В воскресенье это количество умножается на два, то есть от 0,4 до 1,2 за 1 Клик. Теперь представим, что приглашенный пользователь кликнул не 1, а 10 раз в день (что возможно сделать вообще не напрягаясь), то получается он ежедневно принесет от 2 до 6 Кликов, и в воскресенье от 4 до 12 соответственно. И тут наступает самое интересное: таких пользователей не 1, а 62! Следовательно наш "Мамин парень" в день получает от 124 до 372 Кликов в простые дни, и от 248 до 744 Кликов по воскресеньям! А ведь Кликов может быть не 10, а 20 в день...Это означает, что игры стоимостью несколько тысяч Кликов (CS GO, H1Z1 и др), можно получить за несколько дней. Минимум усилий - максимум результата!
    </p>
    <h4>Наши бонусы</h4>

    Мы постоянно проводим розыгрыши среди участников проекта. Расписание еженедельных конкурсов:

    <p>а) по понедельникам производится "Волна Кликов". Случайной сотне участников начисляется по 10 Кликов.</p>
    <p>б) по средам выбирается тройка самых активных участников, по критерию количество приглашенных пользователей. Человек, у которого больше всего рефералов за неделю получит 100 Кликов, второе место 70 и третье получит 30 Кликов.</p>
    <p>в) по пятницам награждаются три самых активных Кликера. Человек, накликавший больше всех за неделю получит 100 Кликов, второе место 70 и третье получит 30 Кликов.</p>
    <p>г) по воскресеньям любой Клик (подтвержденных аккаунтов) умножается на два. Воскресенье - День х2.</p>
    <p>Помимо этого мы регулярно проводим розыгрыши в ВКонтакте, ссылка на нашу официальную страницу: <a href="https://vk.com/steamclicks">https://vk.com/steamclicks</a></p>

@endsection

@section('sidebar')

    @include('widgets.buy')

    @widget('WidgetChat')

    @include('widgets.vk')

    @include('widgets.reklama')


@endsection