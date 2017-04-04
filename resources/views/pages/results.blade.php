@extends('app')

@section('title', 'Призы - ')

@section('content')
    <div>
        <span class="alert alert-warning alert-dismissible" style="display: block">
            <h4>Внимание!</h4>
            <p>Для того чтобы получить купленный предмет, необходимо добавить в своём профиле ссылку для обмена!
                <a href="https://steamclicks.ru/discuss/channels/novosti/ssylka-na-obmen-gde-vzyat">Здесь можно почитать где её взять</a>. <b>Предметы выдаются в ручном режиме после 21:00 (Мск)!</b></p>
        </span>
        {!! Breadcrumbs::render('myitems') !!}
        <ul class="items-list">
            @foreach($items as $item)
                <li class="items-item">
                    <span class="item-buy-name"><img src="{{ $item->icon_url }}" alt="{{ $item->name }}"> {{ $item->name }}</span>
                    @if($item->status == 1)<span class="label label-default">Ожидание выдачи</span>@elseif($item->status == 2)<span class="label label-success">Выдано</span>@endif
                    <div class="pull-right">
                        <span class="item-user">{{ $item->hashcode }}</span>
                    </div>
                    <div class="clearfix"></div>
                </li>
            @endforeach
        </ul>
        <div>{{$items->links()}}</div>
    </div>
@endsection