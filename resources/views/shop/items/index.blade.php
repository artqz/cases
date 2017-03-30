@extends('app')

@section('title', 'Предметы - Магазин - ')

@section('content')
    <div>
        @include('layouts.flash')
        {!! Breadcrumbs::render('items') !!}
        <h1>Предметы</h1>
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
                    <div class="item-card">
                        <div class="item-name">{{ $item->name }}</div>
                        <div class="category-icon"><img src="{{ url('images/games/icons/'.$item->category->appid.'.jpg') }}" alt="{{ $item->category->name }}"></div>
                        <div class="item-image"><img src="{{ $item->icon_url }}" alt="{{ $item->name }}"></div>
                        <div class="price"><span>{{ $item->price }}</span></div>
                        <div><a href="{{ url('/shop/items/'. $item->id .'/buy-item') }}" class="buy">Купить</a></div>
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

    @widget('WidgetChat')

    @include('widgets.reklama')

    @include('widgets.vk')


@endsection