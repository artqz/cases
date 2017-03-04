@extends('app')

@section('title', 'Помощь - ')

@section('content')
    <h1>Помощь</h1>

    <h4>1) Что такое SteamClicks?</h4>

    <strong>SteamClicks</strong> - это единственный сервис предоставляющий возможность получить бесплатно игры и предметы из сообщества Steam.

    <h4>2) Как работает сервис?</h4>

    Вы выполняете простейшие задания, которые мы оплачиваем Вам валютой внутри нашего портала - <strong>"Кликами"</strong>.

    <h4>3) Что такое "Клик" ?</h4>

    Клик - валюта внутри нашего портала, на которую Вы можете приобретать необходимые Вам игры и предметы из игр.

    <h4>4) На что я могу потратить "Клики" ?</h4>

    Потратить "Клики" можно на любые игры из сообщества Steam, предметы популярных игр (таких как <strong>Dota2</strong>, <strong>Counter-Strike</strong>, <strong>Team Fortress</strong>).

    <h4>5) Как потратить "Клики" ?</h4>

    Для того чтобы, потратить "Клики", необходимо зайти в интересующий Вас раздел (Игры или Предметы), выбрать нужный товар и всё.

    Если выбирается Игра, то ссылку на получение Игры Вы получаете в эту же секунду.

    Если выбирается Предмет, вечером этого же дня, Мы со своего аккаунта в Steam'е (ник - <strong>Holyshit_service</strong>, да простит нас Бог, за такой ник) предложим обмен Вашему аккаунту в Steam'е.
    Поэтому Steam должен быть включен всегда.
    <br>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- adaptiv_help -->
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-6809180877585246"
         data-ad-slot="2121888128"
         data-ad-format="auto"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
    <br>
    <h4>6) Как заработать больше "Кликов"?</h4>

    Для того, чтобы зарабатывать больше "Кликов" и быстрее, работает реферальная система. Каждый "Клик" вашего друга, принесет Вам 0,2 бонусных "Клика".

    Если у вас есть хотя бы 5 друзей, соратников по играм, то в день вы будете получать более 10 "Кликов" просто даром. Только подумайте, что будет если друзей больше...

    P.S. можно конечно, заходить почаще самому :)

    <h4>7) Каким образом выбирается ассортимент?</h4>


    Ассортимент подбирается самым простым и лучшим способом - Закон спроса и предложения. На форуме есть специальная Тема для списка Ваших желаний, в которой Вы указываете, те игры и предметы, которые хотели бы получить <strong>БЕСПЛАТНО</strong>. А дальше дело остается за малым - мы добавляем для Вас нужные позиции на сайт.

    <h4>8) Есть ли подобный проект ?</h4>

    Проектов подобного Нашему не существует.

    <h4>9) Планируете ли Вы развиваться?</h4>

    Да, каждый день мы стараемся сделать сервис лучше, разрабатываем дополнительные варианты получения "Кликов", чтобы Вы могли еще быстрее приобрести желаемое.

    <h4>10) Почему мы лучший проект?</h4>

    Потому что не мы управляем всем процессом, а именно Вы! Вы выбираете то, что Вам нужно и сами этого достигаете. Свобода выбора, свобода во всем!

@endsection

@section('sidebar')
    @widget('lastBuyItems')

    @widget('lastBuyGames')

    @widget('lastPosts')
@endsection