@if(count($last_buy_items))
    <div class="panel panel-default">
        <div class="panel-heading">
            Последние купленные вещи
        </div>
        <div class="panel-body">
            <ul class="last-buy-items-list">
                @foreach($last_buy_items as $last_buy_item)
                    <li class="last-buy-items-item">
                        <span class="item-buy-name"><img src="http://steamcommunity-a.akamaihd.net/economy/image/{{ $last_buy_item->icon_url_large }}" alt="{{ $last_buy_item->name }}"> {{ $last_buy_item->name }}</span>
                    </li>
                @endforeach
            </ul>
            </div>
    </div>
@endif

@section('style')
    <style>
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
            position:relative;
            border-bottom: 1px solid #f5f5f5;
            line-height: 3;
        }
        .last-buy-items-item:last-child {
            border-bottom: 0;
        }
    </style>
@endsection