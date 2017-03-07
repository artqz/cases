@extends('app')

@section('title', 'Мои игры - ')

@section('content')
    <div>
        <span class="alert alert-warning alert-dismissible" style="display: block">
            <h4>Внимание!</h4>
            <p>Для того чтобы получить купленную игру, необходимо  скопировать ссылку и ввести её в адресную строку браузера.</p>
        </span>
        {!! Breadcrumbs::render('mygames') !!}
        <ul class="items-list">
            @foreach($games as $game)
                <li class="items-item">
                    <span class="item-buy-name"><img src="{{ $game->header_image }}" alt="{{ $game->name }}"> {{ $game->name }}</span>
                    @if($game->status == 1)<span class="label label-default">Ожидание выдачи</span>@elseif($game->status == 2)<span class="label label-success">Выдано</span>@endif
                    <div class="pull-right">
                        <span class="item-user">{{ $game->data }}</span>
                    </div>
                    <div class="clearfix"></div>
                </li>
            @endforeach
        </ul>
        <div>{{$games->links()}}</div>
    </div>
@endsection

@section('style')
    <style>
        .items-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .item-date {
            font-size: 10px;
            color: #b2b2b2;
        }
        .item-buy-name {
            padding-left: 25px;
            color: #a04eb4;
            margin-bottom: 7px;
            position: relative;
        }
        .item-buy-name img {
            width:20px;
            height:20px;
            position:absolute;
            top:-2px;
            left:0px;
            border-radius:50%;
        }
        .item-user {
            padding-left: 25px;
            color: #a04eb4;
            margin-bottom: 7px;
            position: relative;
        }
        .item-user img {
            width:20px;
            height:20px;
            position:absolute;
            top:-2px;
            left:0px;
            border-radius:50%;
        }
        .items-item {
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