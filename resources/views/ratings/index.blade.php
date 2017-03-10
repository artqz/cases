@extends('app')

@section('title', 'Магазин - ')

@section('content')
    <div>
        <h1>Лучшие</h1>
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
                            <td><img src="https://secure.gravatar.com/avatar/{{ $clicker->user->email_hash }}?s=32&d=identicon"> {{ $clicker->user->name }}</td>
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
                        <th>Кликер</th>
                        <th>Рефералов</th>
                    </tr>
                    @foreach($referrers as $key => $referrer)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td><img src="https://secure.gravatar.com/avatar/{{ $referrer->user->email_hash }}?s=32&d=identicon"> {{ $referrer->user->name }}</td>
                            <td>{{ $referrer->referrals }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

    </div>
@endsection

@section('sidebar')
    @include('widgets.reklama')
    @widget('WidgetLastPosts')
@endsection