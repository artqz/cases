
@if(count($last_buy_games))
    <div class="panel panel-warning">
        <div class="panel-heading">
            Последние купленные игры
        </div>
        <div class="panel-body">
            <ul class="widget-games-list">
                @foreach($last_buy_games as $game)
                    <li class="widget-games-item">
                        <span class="widget-games-user"><img src="https://secure.gravatar.com/avatar/{{ $game->user['email_hash'] }}?s=32&d=identicon">{{ $game->user->name }}</span> купил игру <span class="widget-games-name"><img src="{{ $game->header_image }}" alt="{{ $game->name }}"> {{ $game->name }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif