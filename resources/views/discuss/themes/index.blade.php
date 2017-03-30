@extends('app')

@section('title', $theme->name . ' - ' . $theme->channel->name . ' - Общение - ')

@section('content')
    <div>
        {!! Breadcrumbs::render('themes', $theme->channel, $theme) !!}
        <h1>{{ $theme->name }}</h1>
        <ul class="posts-list">
            @foreach($posts as $post)
                <li class="posts-item">
                    <div class="post-date pull-right">{{ $post->created_at }}</div>
                    <div class="post-author">
                        <img src="{{ avatar($post->user['email_hash'], $post->user['steam_avatar']) }}"> {{ $post->user['name'] }}
                    </div>
                    <div class="post-text">
                        {!! nl2br($post->text !!}
                    </div>
                    <div class="pull-right">
                        @if(\Auth::id() == \Config::get('main.admin_id'))
                            <a href="{{ url('discuss/channels/'. $slug_channel .'/'. $theme->slug .'/'. $post->id .'/delete-post/') }}" class="post-reply btn btn-xs btn-danger">Удалить</a>
                        @endif
                        @if(Auth::id() == $post->user->id)
                        <a href="{{ url('discuss/channels/'. $slug_channel .'/'. $theme->slug .'/'. $post->id .'/edit-post/') }}" class="post-reply btn btn-xs btn-default">Редактировать</a>
                        @endif
                        <a href="{{ url('discuss/channels/'. $slug_channel .'/'. $theme->slug .'/create-post?reply='. $post->user->name) }}" class="post-reply btn btn-xs btn-default">Ответить</a>
                    </div>
                    <div class="clearfix"></div>
                </li>
            @endforeach
        </ul>
        <div>{{$posts->links()}}</div>
    </div>
@endsection

@section('sidebar')

    <div class="panel panel-default">
        <div class="panel-body">
            @if (\Auth::id() == \Config::get('main.admin_id'))
                <div>Тут можно редактировать тему</div><br>
                <a class="btn btn-sm btn-success" href="{{ url('discuss/channels/'. $slug_channel .'/'. $theme->slug .'/edit-theme') }}">Редактировать тему</a>
                <hr>
            @endif
            <div>Может пора написать пост?</div><br>
            <a class="btn btn-sm btn-success" href="{{ url('discuss/channels/'. $slug_channel .'/'. $theme->slug .'/create-post') }}">Добавить пост</a>
        </div>
    </div>

    @widget('WidgetChat')

    @include('widgets.reklama')

    @include('widgets.vk')

@endsection


@section('style')
    <style>
        button[disabled], html input[disabled] {
            cursor: no-drop;
        }
        .posts-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .posts-item {
            margin-bottom: 15px;
            display: block;
            color: #777;
            border: 1px solid #e3e3e3;
            padding: 10px;
            background-color: white;
            position:relative;
        }
        .post-date {
            font-size: 10px;
            color: #b2b2b2;
        }
        .post-author {
            padding-left: 25px;
            color: #a04eb4;
            margin-bottom: 7px;
        }
        .post-author img {
            width:20px;
            height:20px;
            position:absolute;
            top:10px;
            left:10px;
            border-radius:50%;
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