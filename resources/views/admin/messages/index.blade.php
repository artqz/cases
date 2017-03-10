@extends('app')

@section('title', 'Сообщения чата - Панель управления - ')

@section('content')
    @include('layouts.flash')
    {!! Breadcrumbs::render('admin.messages') !!}
    <h1>Сообщения чата</h1>
    <div class="panel panel-default">

        <!-- Table -->
        <table class="table">
            <thead>
                <tr>
                    <th>ИД</th>
                    <th>Текст</th>
                    <th>Юзер</th>
                    <th>Управление</th>
                </tr>
            </thead>
            <tbody>
            @foreach($messages as $message)
                <tr>
                    <td>{{ $message->id }}</td>

                    <td>{{ $message->text }}</td>

                    <td>{{ $message->user->name }}</td>

                    <td>
                        <a class="btn btn-xs btn-danger" href="{{ url('admin/messages/'.$message->id.'/delete-message') }}" onclick="return confirm('Точно удалить?')">Удалить</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div>{{$messages->links()}}</div>
@endsection
