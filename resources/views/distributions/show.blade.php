@extends('app')

@section('title', 'Раздача '.$distribution->game_name.' - ')

@section('content')
    <div>
        @include('layouts.flash')
        {!! Breadcrumbs::render('discuss') !!}
        <h1>Раздача {{ $distribution->game_name }}</h1>

        <div class="distribution">
            <div class="distribution-card">
                <div class="row">
                    <div class="col-md-4">
                        <div class="distribution-image"><img src="{{ $distribution->game_image }}" alt="{{ $distribution->game_name }}"></div>
                    </div>
                    <div class="col-md-8">
                        <div class="distribution-user">Раздача от: <a href="{{ url('users/'.$distribution->user->id) }}"><img src="{{ avatar($distribution->user->email_hash, $distribution->user->steam_avatar) }}">{{ $distribution->user->name }}</a></div>
                        <div class="distribution-steam"><a href="http://store.steampowered.com/app/{{ $distribution->game_id }}/"><i class="fa fa-steam" aria-hidden="true"></i> http://store.steampowered.com/app/{{ $distribution->game_id }}</a></div>
                        <div class="distribution-players">Участников: {{ $distribution->joined_players }} из {{ $distribution->players }} </div>
                        <div class="distribution-price">Ставка: <span class="price">{{ $distribution->price }}</span></div>
                        <div class="distribution-share">
                            <!-- Put this script tag to the <head> of your page -->
                            <script type="text/javascript" src="https://vk.com/js/api/share.js?94" charset="windows-1251"></script>

                            <!-- Put this script tag to the place, where the Share button will be -->
                            <script type="text/javascript">
                                document.write(VK.Share.button(false,{type: "button", text: "Поделиться", url: "{{ url('distribution') }}", title: "{{ $distribution->game_name }}", image: "{{ $distribution->game_image }}", noparse: true}));
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        @if($distribution->user_id != Auth::id())
            @if($distribution->user_winner_id)
                <div class="disable">Раздача завершена!</div>
            @else
                @if (!$check_player)
                    <a class="join" href="{{ url('distributions/'.$distribution->id.'/join') }}">Участвовать</a>
                @endif
            @endif
        @else

        @endif
        <br>
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>Список участников</strong>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Участник</th>
                        <th>Дата подачи</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($distribution->players_list as $key => $player)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td class="user-name"><img src="{{ avatar($player->user->email_hash, $player->user->steam_avatar) }}">{{ $player->user->name }}</td>
                        <td>{{ $player->created_at->diffForHumans() }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('sidebar')
    @if(Auth::id())
        <div class="panel panel-default">
            <div class="panel-body">
                @if(Auth::user()->isTrader == 0)
                    Для того, чтобы создавать свои раздачи необходимо приобрести сертификат торговца за <div class="price" style="display: inline-block;">{{ Config::get('main.price_cert') }}</div>
                    <div class="clearfix"></div>
                    <br>
                    <a class="btn btn-sm btn-warning" href="{{ url('distributions/buy-cert') }}">Купить сертификат</a>
                @else
                    <div>
                        <a class="btn btn-sm btn-success" href="{{ url('distributions/create') }}">Создать раздачу</a>
                    </div>
                @endif
            </div>
        </div>
    @endif

    <div>Отменить раздачу</div>

    @widget('WidgetChat')

    @include('widgets.reklama')
    @include('widgets.vk')

@endsection
