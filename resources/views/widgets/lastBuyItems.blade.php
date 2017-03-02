@if(count($last_buy_items))
    <div class="panel panel-success">
        <div class="panel-heading">
            Последние купленные вещи
        </div>
        <div class="panel-body">
            <ul class="widget-items-list">
                @foreach($last_buy_items as $item)
                    <li class="widget-items-item">
                        <span class="widget-items-user"><img src="https://secure.gravatar.com/avatar/{{ $item->user['email_hash'] }}?s=32&d=identicon">{{ $item->user->name }}</span> купил предмет
                        <span class="widget-items-name"><img src="{{ $item->icon_url }}" alt="{{ $item->name }}"> {{ $item->name }}</span>
                    </li>
                @endforeach
            </ul>
            </div>
    </div>
@endif
