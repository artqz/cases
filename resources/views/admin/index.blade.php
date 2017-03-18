@extends('app')

@section('title', 'Панель управления - ')

@section('content')
    {!! Breadcrumbs::render('admin') !!}
    <ul class="list-group">
        <li class="list-group-item">
            <span class="badge">{{ $items->items_count }}</span>
            <a href="{{ url('admin/items') }}">Предметы</a>
        </li>
        <li class="list-group-item">
            <span class="badge">{{ $items->games_count }}</span>
            <a href="{{ url('admin/games') }}">Игры</a>
        </li>
        <li class="list-group-item">
            <span class="badge">{{ $items->users_count }}</span>
            <a href="{{ url('admin/users') }}">Пользователи</a>
        </li>
        <li class="list-group-item">
            <span class="badge">{{ $items->messages_count }}</span>
            <a href="{{ url('admin/messages') }}">Сообщения чата</a>
        </li>
        <li class="list-group-item">
            <span class="badge">{{ $items->helps_count }}</span>
            <a href="{{ url('admin/helps') }}">Хелпер</a>
        </li>
    </ul>
@endsection