@if($events)
    @foreach($events as $event)
        <li>
            <a class="event-link" href="{{ url('events') }}">
                <img src="{{ $event->image }}" alt="{{ $event->text }}">
                <div class="content">
                    <div class="text">{{ $event->text }}</div>
                    <div class="date">{{ $event->created_at->diffForHumans() }}</div>
                </div>
            </a>
        </li>
    @endforeach
@else
    <li><a href="#">Уведомлений пока нет!</a></li>
@endif