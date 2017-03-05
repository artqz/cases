@if(count($user))
    <div class="panel panel-default">
        <div class="panel-heading">
            Топ кликеров
        </div>
        <div class="panel-body">
            <ul class="widget-users-list">
                @foreach($user as $key => $value)
                    <li class="widget-users-item">
                        {{ $key+1 }}. <span class="widget-themes-user"><img src="https://secure.gravatar.com/avatar/{{ $value->email_hash }}?s=32&d=identicon">{{ $value->name }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif