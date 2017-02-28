@extends('app')

@section('title', 'Общение - ')

@section('content')
    <div>
        {!! Breadcrumbs::render('discuss') !!}
        <h1>Общение</h1>

        <ul class="channels-list">
            @foreach($channels as $channel)
                <li class="channel-item">
                    <div><a href="{{ url('discuss/channels/'.$channel->slug) }}">{{ $channel->name }}</a></div>
                    <div>{{ $channel->description }}</div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection

@section('sidebar')
    @if (\Auth::id() == \Config::get('main.admin_id'))
    <div class="panel panel-default">
        <div class="panel-body">
            <div>Тут можно добавить раздел</div><br>
            <a class="btn btn-sm btn-success" href="{{ url('discuss/create-channel') }}">Добавить раздел</a>
        </div>
    </div>
    @endif
@endsection


@section('style')
    <style>
        button[disabled], html input[disabled] {
            cursor: no-drop;
        }
        .channels-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .channel-item {
            margin-bottom: 15px;
            display: block;
            color: #777;
            border: 1px solid #e3e3e3;
            padding: 10px;
            background-color: white;
            position:relative;
        }
    </style>
@endsection