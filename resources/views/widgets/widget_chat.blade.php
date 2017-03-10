<div class="panel panel-default">
    <div class="panel-heading">
        Чат
    </div>
    <div id="chat" class="panel-body chat">
        <ul class="widget-chat-list">
            @foreach($messages as $message)
                <li class="widget-chat-item">
                    <div class="message-user"><img src="https://secure.gravatar.com/avatar/{{ $message->user->email_hash }}?s=32&d=identicon">{{ $message->user->name }}</div>
                    <div class="message-date pull-right">{{ $message->created_at->diffForHumans() }}</div>
                    <div class="message-text">{{ $message->text }}</div>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="panel-footer">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/chat/create-message') }}">
            {{ csrf_field() }}
            <div class="input-group">
                <input name="text" type="text" class="form-control" required>
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">Ок</button>
                </span>
            </div>
        </form>
    </div>
</div>