@if(count($user))
    <div class="panel panel-default">
        <div class="panel-heading">
            Топ кликеров
        </div>
        <div class="panel-body">
            <ul class="widget-users-list">
                @foreach($user as $key => $value)
                    <li class="widget-users-item">
                        {{ $key+1 }}. <span class="widget-themes-user"><img src="{{ avatar($value->email_hash, $value->steam_avatar) }}">{{ $value->name }}</span>
                        <span>({{ $value->all_clicks }})</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif