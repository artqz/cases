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
                    @foreach($referrers as $key => $referrer)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td class="user-name"><img src="{{ avatar($referrer->user->email_hash, $referrer->user->steam_avatar) }}"> {{ $referrer->user->name }}</td>
                            <td>{{ $referrer->referrals }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <br>
        <div style="text-align: center"><iframe data-aa='499195' src='//ad.a-ads.com/499195?size=728x90' scrolling='no' style='width:728px; height:90px; border:0px; padding:0;overflow:hidden' allowtransparency='true'></iframe></div>
        <br>

    </div>
@endsection

@section('sidebar')
    @include('widgets.buy')

    @widget('WidgetChat')

    @include('widgets.reklama')

@endsection
