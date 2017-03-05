@extends('app')

@section('title', $channel->name . ' - Общение - ')

@section('content')
    <div>
        {!! Breadcrumbs::render('channels', $channel) !!}
        <h1>{{ $channel->name }} <small>{{ $channel->description }}</small></h1>
        <ul class="themes-list">
            @foreach($themes as $theme)
                <li class="themes-item">
                    <a href="{{ url('discuss/channels/'. $channel->slug .'/'. $theme->slug) }}">{{ $theme->name }}</a>
                    <div class="pull-right">
                        <span class="post-author"><img src="https://secure.gravatar.com/avatar/{{ $theme->user->email_hash }}?s=32&d=identicon"> {{ $theme->user->name }}</span>
                        <span class="post-date">{{ $theme->created_at }}</span>
                    </div>
                    <div class="clearfix"></div>
                </li>
            @endforeach
        </ul>
        <div>{{$themes->links()}}</div>
    </div>
@endsection

@section('sidebar')
    @if ($channel->type == 1)
        @if (\Auth::id() == \Config::get('main.admin_id'))
    <div class="panel panel-default">
        <div class="panel-body">
            <div>Тут можно редактировать и удалить раздел</div><br>
            <a class="btn btn-sm btn-success" href="{{ url('discuss/channels/' . $channel->slug . '/edit-channel') }}">Редактировать раздел</a>
            <hr>
            <div>Нет нужной темы? Создай её!</div><br>
            <a class="btn btn-sm btn-success" href="{{ url('discuss/channels/' . $channel->slug . '/create-theme') }}">Добавить тему</a>
        </div>
    </div>
        @endif
    @elseif($channel->type == 0)
        <div class="panel panel-default">
            <div class="panel-body">
                @if (\Auth::id() == \Config::get('main.admin_id'))
                    <div>Тут можно редактировать раздел</div><br>
                    <a class="btn btn-sm btn-success" href="{{ url('discuss/channels/' . $channel->slug . '/edit-channel') }}">Редактировать раздел</a>
                    <hr>
                @endif
                <div>Нет нужной темы? Создай её!</div><br>
                <a class="btn btn-sm btn-success" href="{{ url('discuss/channels/' . $channel->slug . '/create-theme') }}">Добавить тему</a>
            </div>
        </div>
    @endif

    @widget('WidgetLastPosts')

    @include('widgets.reklama')

    @widget('WidgetTopClickers')

    @widget('WidgetBuyGames')

    @widget('WidgetBuyItems')
@endsection


@section('style')
    <style>
        button[disabled], html input[disabled] {
            cursor: no-drop;
        }
        .themes-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .post-date {
            font-size: 10px;
            color: #b2b2b2;
        }
        .post-author {
            padding-left: 25px;
            color: #a04eb4;
            margin-bottom: 7px;
            position: relative;
        }
        .post-author img {
            width:20px;
            height:20px;
            position:absolute;
            top:-2px;
            left:0px;
            border-radius:50%;
        }
        .themes-item {
            margin-bottom: 15px;
            display: block;
            color: #777;
            border: 1px solid #e3e3e3;
            padding: 10px;
            background-color: white;
            position:relative;
        }
        .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
            z-index: 3;
            color: #fff;
            background-color: #ad75bb;
            border-color: #8b7796;
            cursor: default;
        }
        .pagination>li:first-child>a, .pagination>li:first-child>span {
            margin-left: 0;
            border-radius: 0;
        }

        .pagination>li:last-child>a, .pagination>li:last-child>span {
            border-radius: 0;
        }

        .pagination>li>a, .pagination>li>span {
            position: relative;
            float: left;
            padding: 6px 12px;
            line-height: 1.6;
            text-decoration: none;
            color: #a04eb4;
            background-color: #fff;
            border: 1px solid #ddd;
            margin-left: -1px;
        }
    </style>
@endsection