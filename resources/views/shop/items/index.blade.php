@extends('app')

@section('title', 'Предметы - Магазин - ')

@section('content')
    <div>
        @include('layouts.flash')
        {!! Breadcrumbs::render('items') !!}
        <h1>Вещи</h1>
        <div class="items-list row">
            @foreach($items as $item)
                <div class="col-xs-6 col-sm-3 col-md-3">
                    <div class="items-item">
                        <div class="item-name">{{ $item->name }}</div>
                        <img src="{{ $item->icon_url }}" alt="{{ $item->name }}">
                        <div class="item-price">Цена: {{ $item->price }} Клик.</div>
                        <div class="pull-right"><a href="{{ url('/shop/items/'. $item->id .'/buy-item') }}" class="btn btn-xs btn-default">Купить</a></div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="clearfix"></div>
        <div>{{$items->links()}}</div>

    </div>
@endsection

@section('sidebar')
    @if (\Auth::id() == \Config::get('main.admin_id'))
        <div class="panel panel-default">
            <div class="panel-body">
                <div>Тут можно добавить игру или предмет</div><br>
                <a class="btn btn-sm btn-success" href="{{ url('shop/items/create-item') }}">Добавить предмет</a>
            </div>
        </div>
    @endif
@endsection


@section('style')
    <style>
        .items-list {

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
        .items-item img {
            width: 100%;
        }
        .item-name {
            color: #a04eb4;
            margin-bottom: 7px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .item-price {
            margin-top: 15px;
            font-size: 11px;
            color: #b2b2b2;
        }

        .last-buy-items-list {
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
        .last-buy-items-item {
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