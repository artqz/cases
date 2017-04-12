@extends('app')

@section('title', 'Список рефералов - Профиль - ')

@section('content')
    @include('layouts.flash')
    <h1>Список рефералов</h1>
    <div class="panel panel-default">
        <table class="table">
            <tr>
                <th>Имя</th>
                <th>Дата регистрации</th>
                <th>Клики</th>
                <th>Статус</th>
            </tr>
            @foreach($referrals as $referral)
                <tr>
                    <td class="user-name"><img src="{{ avatar($referral->user->email_hash, $referral->user->steam_avatar) }}"> {{ $referral->user->name }}</td>
                    <td>{{ $referral->user->created_at }}</td>
                    <td>{{ $referral->clicks }}</td>
                    <td>
                        @if($referral->user->confirm_email AND $referral->user->steamid)
                            Подтвержден
                        @else
                            Не подтвержден
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div>{{ $referrals->links() }}</div>
@endsection