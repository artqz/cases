@extends('app')

@section('title', 'Панель управления - ')

@section('content')
    {!! Breadcrumbs::render('admin') !!}
    <ul class="list-group">
        <li class="list-group-item">
            <span class="badge">{{ $items_count }}</span>
            <a href="{{ url('admin/items') }}">Предметы</a>
        </li>
        <li class="list-group-item">
            <span class="badge">{{ $games_count }}</span>
            <a href="{{ url('admin/games') }}">Игры</a>
        </li>
        <li class="list-group-item">
            <span class="badge">{{ $users_count }}</span>
            <a href="{{ url('admin/users') }}">Пользователи</a>
        </li>
        <li class="list-group-item">
            <span class="badge">{{ $messages_count }}</span>
            <a href="{{ url('admin/messages') }}">Сообщения чата</a>
        </li>
    </ul>
@endsection