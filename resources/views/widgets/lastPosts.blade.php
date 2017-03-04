@if(count($last_posts))
    <div class="panel panel-primary">
        <div class="panel-heading">
            Последние ответы
        </div>
        <div class="panel-body">
            <ul class="widget-themes-list">
                @foreach($last_posts as $post)
                    <li class="widget-themes-item">
                        <span class="widget-themes-user"><img src="https://secure.gravatar.com/avatar/{{ $post->user['email_hash'] }}?s=32&d=identicon">{{ $post->user->name }}</span> ответил в теме
                        <a href="{{ url('discuss/channels/'.$post->theme->channel->slug.'/'.$post->theme->slug) }}">{{ $post->theme->name }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
@endif