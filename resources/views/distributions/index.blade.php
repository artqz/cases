@extends('app')

@section('title', 'Раздачи - ')

@section('content')
    <div>
        @include('layouts.flash')
        {!! Breadcrumbs::render('discuss') !!}
        <h1>Раздачи</h1>
        <div class="distributions-list">
            @foreach($distributions as $distribution)
                <div class="col-md-12">
                    <div class="distribution-card row">
                        <div class="col-md-4">
                            <div class="distribution-name">Раздача {{ $distribution->game_name }}</div>
                            <div class="distribution-image"><img src="{{ $distribution->game_image }}" alt="Раздача {{ $distribution->game_name }}"></div>
                            <div class="distribution-user"><img src="https://secure.gravatar.com/avatar/{{ $distribution->user->email_hash }}?s=32&d=identicon"> {{ $distribution->user->name }}</div>
                            <div class="distribution-price">Стоимость участия: <span class="price">{{ $distribution->price }}</span></div>
                            <div class="distribution-share">
                                <!-- Put this script tag to the <head> of your page -->
                                <script type="text/javascript" src="https://vk.com/js/api/share.js?94" charset="windows-1251"></script>

                                <!-- Put this script tag to the place, where the Share button will be -->
                                <script type="text/javascript">
                                    document.write(VK.Share.button(false,{type: "button", text: "Поделиться", url: "{{ url('distribution') }}", title: "{{ $distribution->game_name }}", image: "{{ $distribution->game_image }}", noparse: true}));
                                </script>
                            </div>
                        </div>
                        <div class="col-md-8">
                            @if($distribution->user_winner_id)
                                <div class="row">
                                    Конкур закончен!
                                </div>
                            @else
                            <div class="distribution-players">Участников: {{ $distribution->joined_players }} из {{ $distribution->players }}</div>

                            <div class="row">
                            @foreach($distribution->players_list as $player)
                                <div class="col-md-4">
                                    <div class="player-name">
                                        <img src="https://secure.gravatar.com/avatar/{{ $player->user->email_hash }}?s=32&d=identicon"> {{ $player->user->name }}
                                    </div>
                                </div>
                            @endforeach
                            </div>
                            @endif
                        </div>
                        <div class="col-md-12">
                            @if($distribution->user_id != Auth::id())
                                @if($distribution->user_winner_id)
                                    <div class="disable">Раздача завершена!</div>
                                @else
                                    <a class="buy" href="{{ url('distributions/'.$distribution->id.'/join') }}">Участвовать</a>
                                @endif
                            @else

                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection

@section('sidebar')
    <div class="panel panel-default">
        <div class="panel-body">
            @if(Auth::user()->isTrader == 0)
            Для того, чтобы создавать свои раздачи необходимо преобрести сертификат торговца за <div class="price" style="display: inline-block;">{{ Config::get('main.price_cert') }}</div>
            <div class="clearfix"></div>
            <br>
            <a class="btn btn-sm btn-warning" href="{{ url('distributions/buy-cert') }}">Купить сертификат</a>
            <hr>
            @endif
            <div>Тут можно создать раздачу</div><br>
            <a class="btn btn-sm btn-success" href="{{ url('distributions/create') }}">Создать раздачу</a>
        </div>
    </div>

    @widget('WidgetChat')

    @include('widgets.reklama')

    @widget('WidgetTopClickers')

    @widget('WidgetLastPosts')

@endsection


@section('style')
    <style>
        button[disabled], html input[disabled] {
            cursor: no-drop;
        }
        .channels-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .channel-item {
            margin-bottom: 15px;
            display: block;
            color: #777;
            border: 1px solid #e3e3e3;
            padding: 10px;
            background-color: white;
            position:relative;
        }
    </style>
@endsection