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
    <div class="container">
        <h2>Последние купленные вещи</h2>
        <ul class="last-buy-items-list">
        @foreach($last_buy_items as $last_buy_item)
            <li class="last-buy-items-item">
                <span class="item-name"><img src="http://steamcommunity-a.akamaihd.net/economy/image/{{ $last_buy_item->icon_url_large }}" alt="{{ $last_buy_item->name }}"> {{ $last_buy_item->name }}</span>
                    @if($last_buy_item->status == 1)<span class="label label-default">Ожидание выдачи</span>@elseif($last_buy_item->status == 2)<span class="label label-success">Выдано</span>@endif
                <div class="pull-right">
                    <span class="item-user"><img src="https://secure.gravatar.com/avatar/{{ $last_buy_item->user->email_hash }}?s=32&d=identicon"> {{ $last_buy_item->user->name }}</span>
                    <span class="item-date">{{ $last_buy_item->updated_at }}</span>
                </div>
                <div class="clearfix"></div>
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

        .last-buy-items-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .item-date {
            font-size: 10px;
            color: #b2b2b2;
        }
        .item-name {
            padding-left: 25px;
            color: #a04eb4;
            margin-bottom: 7px;
            position: relative;
        }
        .item-name img {
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