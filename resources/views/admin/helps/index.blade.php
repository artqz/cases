@extends('app')

@section('title', 'Хелпер - Панель управления - ')

@section('content')
    @include('layouts.flash')
    {!! Breadcrumbs::render('admin.games') !!}
    <h1>Хелпер</h1>
    <div class="panel panel-default">

        <!-- Table -->
        <table class="table">
            <thead>
                <tr>
                    <th>ИД</th>
                    <th>Наименование</th>
                    <th>Управление</th>
                </tr>
            </thead>
            <tbody>
            @foreach($helps as $help)
                <tr>
                    <td>{{ $help->id }}</td>

                    <td>{{ $help->name }} ({{ $help->price }})</td>

                    <td><a class="btn btn-xs btn-primary" href="{{ url('admin/helps/'.$help->id.'/edit') }}">Редактировать</a> <a class="btn btn-xs btn-danger" href="{{ url('admin/helps/'.$help->id.'/delete') }}" onclick="return confirm('Точно удалить?')">Удалить</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div>{{$helps->links()}}</div>
@endsection

@section('sidebar')
    <div class="panel panel-default">
        <div class="panel-body">
            <div>Тут можно добавить хелпер</div><br>
            <a class="btn btn-sm btn-success" href="{{ url('admin/helps/create') }}">Добавить хелпер</a>
        </div>
    </div>
@endsection