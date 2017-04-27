@extends('app')

@section('title', 'FAQ - ')

@section('content')
    <h1>FAQ Steam Clicks</h1>
    <div class="row">
        <div class="col-sm-6 col-md-6">
            <ul class="faq-menu">
                @foreach($helps as $key => $help)
                    <li><a href="#{{ $help->id }}">{{ $key+1 }}. {{ $help->name }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="col-sm-6 col-md-6">
            <iframe data-aa='499199' src='//ad.a-ads.com/499199?size=336x280' scrolling='no' style='width:336px; height:280px; border:0px; padding:0;overflow:hidden' allowtransparency='true'></iframe>
        </div>
    </div>
    <div>Хотите почитать <a href="{{ url('rules') }}">правила Steam Clicks</a>?</div>
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

    @include('widgets.buy')

    @widget('WidgetChat')

    @include('widgets.vk')

    @include('widgets.reklama')


@endsection