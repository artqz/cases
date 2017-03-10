@extends('app')

@section('title', 'Предметы - Панель управления - ')

@section('content')
    @include('layouts.flash')
    {!! Breadcrumbs::render('admin.items') !!}
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
                    <th>Хэш</th>
                    <th>Управление</th>
                </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>

                    <td>{{ $item->name }} ({{ $item->price }})</td>

                    <td> @if($item->status == 1)<span class="label label-default">Ожидание выдачи</span>@elseif($item->status == 2)<span class="label label-success">Выдано</span>@elseif($item->status == 0)<span class="label label-warning">Продается</span>@endif</td>

                    <td>{{ $item->user_id ? $item->user->name : 'Нет' }}</td>

                    <td>{{ $item->hashcode ? $item->hashcode : 'Нет'  }}</td>

                    <td>
                        @if($item->user_id)<a class="btn btn-xs btn-success" href="{{ $item->user->tradeoffer }}">Передать</a>@endif
                        <a class="btn btn-xs btn-success" href="{{ url('admin/items/'.$item->id.'/give-item') }}" onclick="return confirm('Точно выдал?')">Выдал</a>
                        <a class="btn btn-xs btn-primary" href="{{ url('admin/items/'.$item->id.'/edit-item') }}">Редактировать</a>
                        <a class="btn btn-xs btn-danger" href="{{ url('admin/items/'.$item->id.'/delete-item') }}" onclick="return confirm('Точно удалить?')">Удалить</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div>{{$items->links()}}</div>
@endsection

@section('sidebar')
    <div class="panel panel-default">
        <div class="panel-body">
            <div>Тут можно добавить предмет</div><br>
            <a class="btn btn-sm btn-success" href="{{ url('admin/items/create-item') }}">Добавить предмет</a>
        </div>
    </div>
@endsection