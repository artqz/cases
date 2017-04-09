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
                    <div class="item-card" data-toggle="tooltip" data-placement="top" title="{{ $item->name }} ({{ $item->type }} )">
                        <div class="item-name" style="color: #{{ $item->name_color }};">{{ $item->name }}</div>
                        <div class="category-icon"><img src="{{ url('images/games/icons/'.$item->category->appid.'.jpg') }}" alt="{{ $item->category->name }}"></div>
                        <div class="item-image">
                            <div class="type" style="background-color: #{{ $item->name_color }};"></div>
                            <img src="{{ $item->icon_url }}" alt="{{ $item->name }}">
                        </div>
                        <div class="price"><span>{{ $item->price }}</span></div>
                        <div><a href="{{ url('/shop/items/'. $item->id .'/buy-item') }}" class="buy" onclick="return confirm('Точно хотите купить?')">Купить</a></div>
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
    @include('widgets.buy')

    @if (\Auth::id() == \Config::get('main.admin_id'))
        <div class="panel panel-default">
            <div class="panel-body">
                <div>Тут можно добавить игру или предмет</div><br>
                <a class="btn btn-sm btn-success" href="{{ url('shop/items/create-item') }}">Добавить предмет</a>
            </div>
        </div>
    @endif

    @include('widgets.vk')

    @widget('WidgetChat')

    @include('widgets.reklama')


@endsection

@section('scripts')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    @endsection