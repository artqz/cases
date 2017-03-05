@extends('app')

@section('title', 'Предметы - Панель управления - ')

@section('content')
    @include('layouts.flash')
    {!! Breadcrumbs::render('admin.games') !!}
    <h1>Предметы</h1>
    <div class="panel panel-default">

        <!-- Table -->
        <table class="table">
            <thead>
                <tr>
                    <th>ИД</th>
                    <th>Наименование</th>
                    <th>Статус</th>
                    <th>Юзер</th>
                    <th>Гифт</th>
                    <th>Управление</th>
                </tr>
            </thead>
            <tbody>
            @foreach($games as $game)
                <tr>
                    <td>{{ $game->id }}</td>

                    <td>{{ $game->name }} ({{ $game->price }})</td>

                    <td> @if($game->status == 1)<span class="label label-default">Ожидание выдачи</span>@elseif($game->status == 2)<span class="label label-success">Выдано</span>@elseif($game->status == 0)<span class="label label-warning">Продается</span>@endif</td>

                    <td>{{ $game->user_id ? $game->user->name : 'Нет' }}</td>

                    <td>{{ $game->data }}</td>

                    <td><a class="btn btn-xs btn-primary" href="{{ url('admin/games/'.$game->id.'/edit-game') }}">Редактировать</a> <a class="btn btn-xs btn-danger" href="{{ url('admin/games/'.$game->id.'/delete-game') }}" onclick="return confirm('Точно удалить?')">Удалить</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div>{{$games->links()}}</div>
@endsection

@section('sidebar')
    <div class="panel panel-default">
        <div class="panel-body">
            <div>Тут можно добавить игру</div><br>
            <a class="btn btn-sm btn-success" href="{{ url('admin/games/create-game') }}">Добавить игру</a>
        </div>
    </div>
@endsection