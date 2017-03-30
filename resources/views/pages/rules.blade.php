@extends('app')

@section('title', 'Правила - ')

@section('content')
    <h1>Правила проекта</h1>
    <p>1. Запрещается создавать мульти-аккаунты. Другими словами - нельзя регистрировать одному человеку много аккаунтов на себя и управлять ими.</p>
    <p>2. Запрещаются нецензурные выражения и оскорбления на форуме и мини-чате.</p>
    <p>3. Запрещается реклама своих проектов на страницах нашего форума и мини-чата без согласия администратора.</p>
    <p>4. Запрещать добавлять посты с целью продажи своих услуг и товаров. Не размещайте ссылки на страницы в социальных сетях и интернет-магазинах с целью продажи своих услуг и товаров.</p>
    <p>5. Запрещается обман других пользователей, предложение своих услуг с корыстными намерениями. </p>

    <p>Пренебрежение правилами могут повлечь за собой потерю Кликов или блокировку аккаунта. Поэтому правила необходимо соблюдать.</p>

@endsection

@section('sidebar')
    @widget('WidgetChat')

    @include('widgets.reklama')
    @include('widgets.vk')

@endsection