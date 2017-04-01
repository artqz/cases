@extends('app')

@section('title', 'Купить кристаллы - ')

@section('content')
    <div>
        @include('layouts.flash')

        <div><a href="{{ url('donate/buy/1') }}">Купить 1 кристалл</a></div>
        <div><a href="{{ url('donate/buy/5') }}">Купить 5 кристаллов</a></div>
        <div><a href="{{ url('donate/buy/10') }}">Купить 10 кристаллов</a></div>
    </div>
@endsection

@section('sidebar')
    @widget('WidgetChat')

    @include('widgets.reklama')

    @include('widgets.vk')

@endsection