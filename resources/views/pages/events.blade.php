@extends('app')

@section('content')
    <div>
        <h1>Уведомления</h1>
        <div class="list">
            @foreach($events as $event)
                <div class="card event">
                    <div class="col-sm-3">
                        <div class="image"><img src="{{ $event->image }}" alt="{{ $event->text }}"></div>
                    </div>
                    <div class="col-sm-9">
                        <div class="content">
                            <div class="text"><a href="{{ $event->url }}">{{ $event->text }}</a></div>
                            <div class="data" style="color: #0c9f0c"><i>{{ $event->data }}</i></div>
                            <div class="date">{{ $event->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('sidebar')

    @include('widgets.buy')

    @widget('WidgetChat')

    @include('widgets.vk')

    @include('widgets.reklama')


@endsection
