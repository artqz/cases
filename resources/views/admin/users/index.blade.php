@extends('app')

@section('title', 'Пользователи - Панель управления - ')

@section('content')
    @include('layouts.flash')
    {!! Breadcrumbs::render('admin.users') !!}
    <h1>Пользователи</h1>
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

                    <td>{{ $user->name }}</td>

                    <td>{{ $user->email }}</td>

                    <td>{{ $user->clicks }}</td>

                    <td>{{ $user->user_ref_id }}</td>

                    <td><a class="btn btn-xs btn-primary" href="{{ url('admin/users/'.$user->id.'/edit-user') }}">Редактировать</a> <a class="btn btn-xs btn-danger" href="{{ url('admin/users/'.$user->id.'/delete-user') }}" onclick="return confirm('Точно удалить?')">Удалить</a></td>
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
            <div>Пользователя нельзя создать, так как есть регистрация!</div>
        </div>
    </div>
@endsection
