@extends('app')

@section('title', 'Пользователи - Панель управления - ')

@section('content')
    @include('layouts.flash')
    {!! Breadcrumbs::render('admin.users') !!}
    <h1>Пользователи</h1>
    <form action="{{ url('admin/users') }}" method="get">
        <div class="input-group">
            <select class="form-control" name="filter">
                <option value="clicks">Клики</option>
                <option value="crystals">Кристаллы</option>
            </select>
            <span class="input-group-btn">
                <button class="btn btn-default" type="submit">Go!</button>
            </span>
        </div>
    </form>
    <br>
    <div class="panel panel-default">

        <!-- Table -->
        <table class="table">
            <thead>
                <tr>
                    <th>ИД</th>
                    <th>Наименование</th>
                    <th>Эл. почта</th>
                    <th>Клики</th>
                    <th>Реф</th>
                    <th>Управление</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>

                    <td><img src="{{ avatar($user->email_hash, $user->steam_avatar) }}" style="width: 24px"> {{ $user->name }} {!!  ($user->isBanned == 1) ? '<span class="label label-danger">BAN</span>' : '' !!}</td>

                    <td>{{ $user->email }}<br>
                        ({{ $user->ip_address }})</td>

                    <td>{{ $user->clicks }}</td>

                    <td>{{ $user->user_ref_id }}</td>

                    <td>
                        <a class="btn btn-xs btn-warning" href="{{ url('admin/users/'.$user->id.'/create-reward') }}">Наградить</a>
                        <a class="btn btn-xs btn-primary" href="{{ url('admin/users/'.$user->id.'/edit-user') }}">Редактировать</a>
                        <a class="btn btn-xs btn-danger" href="{{ url('admin/users/'.$user->id.'/delete-user') }}" onclick="return confirm('Точно удалить?')">Удалить</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div>{{$users->links()}}</div>
@endsection

@section('sidebar')
    <div class="panel panel-warning">
        <div class="panel-body">
            <div>Поиск пользователя</div>
            <br>
            <form method="get" action="{{ url('admin/users/search') }}">
                <div class="input-group">
                    <input type="text" name="q" class="form-control">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">Go!</button>
                    </span>
                </div>
            </form>
        </div>
    </div>
    <div class="panel panel-warning">
        <div class="panel-body">
            <div>Пользователя нельзя создать, так как есть регистрация!</div>
            <br>
            <a class="btn btn-sm btn-warning" href="{{ url('admin/users/create-reward-hundred') }}">Наградить 100 активных</a>
        </div>
    </div>
@endsection
