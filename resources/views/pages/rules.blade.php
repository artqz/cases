@extends('app')

@section('title', 'Правила - ')

@section('content')
    <h1>Правила Steam Clicks</h1>
    <p>1. Запрещается создавать мульти-аккаунты. Другими словами нельзя регистрировать одному человеку много аккаунтов на себя.</p>
    <p>2. Запрещаются нецензурные выражения на форуме и мини-чате.</p>
    <p>3. Запрещается реклама своих проектов на страницах нашего форума и мини-чата без согласия администратора.</p>
    <p>4. Запрещается обман других пользователей, предложение своих услуг с корыстными намерениями.</p>

    <p>Пренебрежение правилами могут повлечь за собой потерю Кликов или блокировку аккаунта. Поэтому, давайте жить дружно.</p>

@endsection

@section('sidebar')
    @widget('WidgetChat')

    @include('widgets.reklama')

@endsection