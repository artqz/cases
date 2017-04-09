@extends('app')

@section('title', 'Профиль '.$items->user->name.' - ')

@section('content')
    <div>
        <h1>Профиль {{ $items->user->name }}</h1>
        <div class="profile-card">
            <div class="row">
            <div class="col-sm-3"><img class="avatar" src="{{ avatar($items->user->email_hash, $items->user->steam_avatar) }}"></div>
            <div class="col-sm-9">
                <div>Дата регистрации: {{ $items->user->created_at }}</div>
                @if($items->user->isTrader >= 1)
                    <div>Ранг: Торговец {{ $items->user->isTrader }} уровня</div>
                @else
                    <div>Ранг: Пользователь</div>
                @endif
                <div>Кол-во рефералов: {{ $items->referrals_count }}</div>
                <div>Рейтинг: {{ $items->user->rating }}</div>
                <div>Профиль Steam: <a href="{{ $items->user->steam_profile }}">{{ $items->user->steam_profile }}</a></div>
            </div>
            <div class="clearfix"></div>
            </div>
        </div>
        @if(Auth::id() == 1)
            <div class="row">
                <div class="col-md-6">
                    <div role="tabpanel" class="tab-pane active" id="clicks">
                        <div class="panel panel-default">
                            <div class="panel-heading">Последние 30 кликов</div>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Кол-во</th>
                                        <th>Время получения</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items->clicks as $key => $click)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $click->clicks }}</td>
                                            <td>{{ $click->created_at->diffForHumans() }} ({{ $click->created_at }})</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('sidebar')

    @widget('WidgetChat')

    @include('widgets.reklama')

    @include('widgets.vk')

@endsection