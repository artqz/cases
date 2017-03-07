@extends('app')

@section('title', 'Предметы - Магазин - ')

@section('content')
    <div>
        @include('layouts.flash')
        {!! Breadcrumbs::render('items') !!}
        <h1>Вещи</h1>
        <div class="row items-categories">
            @foreach($categories as $category)
                <div class="col-sm-3 col-md-3">
                    <a class="category {{ Request::is('shop/items/g/'.$category->category->appid) ? 'active' : '' }}" href="{{ url('shop/items/g/'.$category->category->appid) }}">
                        <img class="category-icon" src="{{ url('images/games/icons/'.$category->category->appid.'.jpg') }}" alt="{{ $category->category->name }}">
                        <span class="category-name">{{ $category->category->name }}</span>
                    </a>
                </div>
            @endforeach
        </div>
        <br>
        <div class="items-list row">
            @foreach($items as $item)
                <div class="col-xs-6 col-sm-3 col-md-3">
                    <div class="items-item">
                        <div class="item-name">{{ $item->name }}</div>
                        <img src="{{ $item->icon_url }}" alt="{{ $item->name }}">
                        <div class="item-price">Цена: {{ $item->price }} Клик.</div>
                        <div class="pull-right"><a href="{{ url('/shop/items/'. $item->id .'/buy-item') }}" class="btn btn-xs btn-default">Купить</a></div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="clearfix"></div>
        <div>{{$items->links()}}</div>

    </div>
@endsection

@section('sidebar')
    @if (\Auth::id() == \Config::get('main.admin_id'))
        <div class="panel panel-default">
            <div class="panel-body">
                <div>Тут можно добавить игру или предмет</div><br>
                <a class="btn btn-sm btn-success" href="{{ url('shop/items/create-item') }}">Добавить предмет</a>
            </div>
        </div>
    @endif

    @widget('WidgetLastPosts')

    @include('widgets.reklama')

    @widget('WidgetTopClickers')

    @widget('WidgetBuyGames')

    @widget('WidgetBuyItems')
@endsection