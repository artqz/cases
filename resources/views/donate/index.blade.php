@extends('app')

@section('title', 'Купить кристаллы - ')

@section('content')
    <div>
        @include('layouts.flash')

        <div><a href="{{ url('donate/buy-one') }}">Купить 1 кристалл</a></div>
        <div><a href="{{ url('donate/buy-five') }}">Купить 5 кристаллов</a></div>
        <div><a href="{{ url('donate/buy-ten') }}">Купить 10 кристаллов</a></div>
    </div>
@endsection

@section('sidebar')
    @widget('WidgetChat')

    @include('widgets.reklama')

    @include('widgets.vk')

@endsection