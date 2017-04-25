@extends('app')

@section('title', 'Раздача '.$distribution->data_name.' - ')

@section('meta')
    <meta property="og:type" content="distribution" />
    <meta property="og:title" content="Прямо сейчас раздается {{ $distribution->data_name }} - Все сюда!" />
    <meta property="og:description" content="Бесплатная раздача {{ $distribution->data_name }} на steamclicks.ru. Участвуй со мной!" />
    <meta property="og:url" content="{{ url('distributions/'.$distribution->slug) }}" />
    <meta property="og:image" content="{{ url($distribution->data_image) }}" />
@endsection

@section('content')
    <div>
        @include('layouts.flash')
        {!! Breadcrumbs::render('distribution', $distribution) !!}
        <h1>{{ $distribution->data_name }}</h1>

        <div class="distribution">
            <div class="distribution-card">
                <div class="row">
                    <div class="col-md-4">
                        <div class="distribution-image"><img src="{{ $distribution->data_image }}" alt="{{ $distribution->data_name }}"></div>
                    </div>
                    <div class="col-md-8">
                        <div class="distribution-user">Раздача от: <a href="{{ url('users/'.$distribution->user->id) }}"><img src="{{ avatar($distribution->user->email_hash, $distribution->user->steam_avatar) }}">{{ $distribution->user->name }}</a></div>
                        <div class="distribution-steam"><a href="http://store.steampowered.com/{{ $distribution->data_type }}/{{ $distribution->data_id }}/"><i class="fa fa-steam" aria-hidden="true"></i> http://store.steampowered.com/{{ $distribution->data_type }}/{{ $distribution->data_id }}</a></div>
                        <div class="distribution-players">Участников: {{ $distribution->joined_players }} из {{ $distribution->players }} </div>
                        <div class="distribution-price">Ставка: <span class="price {{ ($distribution->level == 2) ? 'crystal' : '' }}">{{ $distribution->price }}</span></div>
                        @if($distribution->description)
                            <div class="distribution-price">Описание: {!! nl2br(strip_tags($distribution->description)) !!}</div>
                        @endif
                        <div class="distribution-region">Регион: {{ region($distribution->data_region) }}</div>
                        <div class="distribution-share">
                            <!-- Put this script tag to the <head> of your page -->
                            <script type="text/javascript" src="https://vk.com/js/api/share.js?94" charset="windows-1251"></script>

                            <!-- Put this script tag to the place, where the Share button will be -->
                            <script type="text/javascript">
                                document.write(VK.Share.button(false,{type: "button", text: "Поделиться", url: "{{ url('distribution') }}", title: "{{ $distribution->data_name }}", image: "{{ $distribution->data_image }}", noparse: true}));
                            </script>
                            @if($distribution->user_id == Auth::id())
                            <br>
                            <a class="btn btn-xs btn-warning" href="{{ url('distributions/'.$distribution->slug.'/up') }}">Поднять раздачу за 10 Кликов</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($distribution->status == 2)
            <div class="disable">Торговец отменил раздачу!</div>
        @else
            @if($distribution->user_id != Auth::id())
                <br>
                @if($distribution->user_winner_id)
                    <div class="disable">Раздача завершена! Победил: <span class="user-name"><a href="{{ url('users/'.$distribution->user_winner->id) }}"><img src="{{ avatar($distribution->user_winner->email_hash, $distribution->user_winner->steam_avatar) }}">{{ $distribution->user_winner->name }}</a></span></div>
                @else
                    @if (!$check_player)
                        <a class="join" href="{{ url('distributions/'.$distribution->slug.'/join') }}">Участвовать</a>
                    @endif
                @endif
            @else

            @endif
            @if($distribution->user_id == Auth::id())
                <br>
                @if($distribution->user_winner_id)
                    <div class="disable">Раздача завершена! Победил: <span class="user-name"><a href="{{ url('users/'.$distribution->user_winner->id) }}"><img src="{{ avatar($distribution->user_winner->email_hash, $distribution->user_winner->steam_avatar) }}">{{ $distribution->user_winner->name }}</a></span></div>
                @else
                    <a class="cancel" href="{{ url('distributions/'.$distribution->slug.'/cancel') }}" onclick="return confirm('Точно отменить?')">Завершить раздачу и вернуть клики</a>
                @endif
            @endif

            @if($distribution->comment)
                <br>
                <div>
                    <div class="card" style="{{ ($distribution->rating == 1) ? 'background-color: #daf8db' : 'background-color: #f8dbda' }}">
                        <h4>Отзыв победителя:</h4>
                        {{ $distribution->comment }}
                    </div>
                </div>
            @endif

            @if($distribution->user_winner_id == Auth::id() && $distribution->comment == null)
                <form class="form-horizontal" role="form" method="POST" action="{{ url('distributions/'.$distribution->slug.'/comment') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                        <div class="col-md-12">
                        <h4>Отзыв</h4>
                            <textarea class="form-control" name="comment" id="comment" cols="30" rows="5" required></textarea>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('rating') ? ' has-error' : '' }}">
                        <div class="col-md-12">
                            <input type="radio" name="rating" id="pure-toggle" value="1" required hidden/>
                            <label class="pure-toggle" for="pure-toggle">
                                <i class="fa fa-thumbs-up Ok" aria-hidden="true">
                                </i>
                            </label>

                            <input type="radio" name="rating" id="pure-toggle2" value="-1" required hidden/>
                            <label class="pure-toggle" for="pure-toggle2">
                                <i class="fa fa-thumbs-down Nok" aria-hidden="true">
                                </i>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Отправить
                            </button>
                        </div>
                    </div>
                </form>
            @endif
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
                        <td class="user-name"><a href="{{ url('users/'.$player->user->id) }}"><img src="{{ avatar($player->user->email_hash, $player->user->steam_avatar) }}">{{ $player->user->name }}</a></td>
                        <td>{{ $player->created_at->diffForHumans() }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('sidebar')
    @include('widgets.buy')
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

    @widget('WidgetChat')

    @include('widgets.vk')

    @include('widgets.reklama')

@endsection
