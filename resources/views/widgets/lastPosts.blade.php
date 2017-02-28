<div class="panel panel-warning">
    <div class="panel-heading">
        Последние ответы
    </div>
    <div class="panel-body">
        <ul class="last-buy-items-list">
        @foreach($last_posts as $post)
            {{ $post->user->name }} ответил в теме {{ $post->theme->name }}
        @endforeach
        </ul>
    </div>
</div>