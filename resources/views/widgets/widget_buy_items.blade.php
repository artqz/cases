@if(count($last_buy_items))
    <div class="panel panel-success">
        <div class="panel-heading">
            Последние купленные вещи
        </div>
        <div class="panel-body">
            <ul class="widget-items-list">
                @foreach($last_buy_items as $item)
                    <li class="widget-items-item">
                        <span class="widget-items-user"><img src="{{ avatar($item->user['email_hash'], $item->user['steam_avatar']) }}">{{ $item->user->name }}</span> купил предмет
                        <span class="widget-items-name"><img src="{{ $item->icon_url }}" alt="{{ $item->name }}"> {{ $item->name }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
