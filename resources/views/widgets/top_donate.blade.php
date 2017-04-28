@if(count($orders))
    <div class="panel panel-default">
        <div class="panel-heading">
            Последние донаты
        </div>
        <div class="panel-body">
            <ul class="widget-themes-list">
                @foreach($orders as $order)
                    <li class="widget-themes-item">
                        <span class="widget-themes-user"><img src="{{ avatar($order->user['email_hash'], $order->user['steam_avatar']) }}">{{ $order->user->name }}</span> задонатил
                        {{ $order->sum }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif