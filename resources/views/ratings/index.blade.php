@extends('app')

@section('title', 'Рейтинг - ')

@section('content')
    <h1>Лучшие</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Топ 10 Кликеров за неделю</strong>
                </div>
                <table class="table">
                    <tr>
                        <th>#</th>
                        <th>Кликер</th>
                        <th>Кол-во кликов</th>
                    </tr>
                    @foreach($clickers as $key => $clicker)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td class="user-name"><img src="{{ avatar($clicker->user->email_hash, $clicker->user->steam_avatar) }}"> {{ $clicker->user->name }}</td>
                            <td>{{ $clicker->clicks }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Топ 10 Реферов за неделю</strong>
                </div>
                <table class="table">
                    <tr>
                        <th>#</th>
                        <th>Реферер</th>
                        <th>Кол-во рефералов</th>
                    </tr>
                    @foreach($referrers->where('isBanned', 0) as $key => $referrer)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td class="user-name"><img src="{{ avatar($referrer->user->email_hash, $referrer->user->steam_avatar) }}"> {{ $referrer->user->name }}</td>
                            <td>{{ $referrer->referrals }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

    </div>
@endsection

@section('sidebar')
    @widget('WidgetChat')

    @include('widgets.reklama')

    @widget('WidgetTopClickers')

    @widget('WidgetLastPosts')

@endsection
