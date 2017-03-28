@extends('app')

@section('title', 'FAQ - ')

@section('content')
    <h1>FAQ Steam Clicks</h1>

    <ul class="faq-menu">
        @foreach($helps as $key => $help)
            <li><a href="#{{ $help->id }}">{{ $key+1 }}. {{ $help->name }}</a></li>
        @endforeach
    </ul>
    <div>Хотите почитать правила <a href="#">Steam Clicks</a>?</div>
    <br>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- adaptiv_help -->
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-6809180877585246"
         data-ad-slot="2121888128"
         data-ad-format="auto"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
    <br>

    <div class="faq-list">
        @foreach($helps as $key => $help)
            <div id="{{ $help->id }}">
                <a href="#{{ $help->id }}"><h4>{{ $key+1 }}. {{ $help->name }}</h4></a>
                <div class="content">
                    {!! nl2br($help->text) !!}
                </div>
            </div>
        @endforeach
    </div>

@endsection

@section('sidebar')
    @widget('WidgetChat')

    @include('widgets.reklama')

    @widget('WidgetTopClickers')

    @widget('WidgetLastPosts')

@endsection