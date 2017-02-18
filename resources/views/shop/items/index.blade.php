@extends('app')

@section('content')
    <div class="container">
        <h1>Вещи</h1>
        <ul class="items-list">
            @foreach($items as $item)
                <li class="col-xs-6 col-sm-3 col-md-3">
                    <div class="items-item">
                        <div class="item-name">{{ $item->name }}</div>
                        <img src="http://steamcommunity-a.akamaihd.net/economy/image/{{ $item->icon_url_large }}" alt="{{ $item->name }}">
                        <div class="item-price">Цена: {{ $item->price }} Клик.</div>
                        <div class="pull-right"><a href="{{ url('/shop/items/'. $item->id .'/buy-item') }}" class="btn btn-xs btn-default">Купить</a></div>
                        <div class="clearfix"></div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection


@section('style')
    <style>
        .items-list {
            list-style: none;
            padding: 0;
            margin: 0;
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
        }
        .item-price {
            margin-top: 15px;
            font-size: 11px;
            color: #b2b2b2;
        }
    </style>
@endsection