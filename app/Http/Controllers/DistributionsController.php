<?php

namespace App\Http\Controllers;

use App\Distribution;
use App\Event;
use App\Helpers\SlugHelper;
use App\Helpers\SteamHelper;
use App\Player;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Config;

class DistributionsController extends Controller
{
    public function index($type = null)
    {
        Carbon::setLocale('ru');

        if ($type == 'premium') {
            $distributions = Distribution::where('level', 2)
                ->where('status', 0)
                ->orderBy('topped_at', 'desc')
                ->paginate(30);
        } elseif ($type == 'active') {
            $distributions = Distribution::where('status', 0)
                ->orderBy('topped_at', 'desc')
                ->paginate(30);
        } elseif ($type == 'passed') {
            $distributions = Distribution::where('status', 1)->orWhere('status', 2)
                ->orderBy('topped_at', 'desc')
                ->paginate(30);
        } else {
            $distributions = Distribution::orderBy('topped_at', 'desc')
                ->paginate(30);
        }

        return view('distributions.index', compact('distributions'));
    }

    /**
     * @return string
     */
    public function buy_cert()
    {
        //Только для подтвержденных аккаунтов
        if (Auth::user()->steamid && Auth::user()->confirm_email) {
            $user = User::where('id', \Auth::id())->first();

            if ($user->isTrader == 0) {
                if ($user->clicks >= Config::get('main.price_cert')) {
                    User::where('id', \Auth::id())->update([
                        'clicks' => $user->clicks - Config::get('main.price_cert'),
                        'isTrader' => 1,
                    ]);

                    return redirect('distributions')->with([
                        'flash_message' => 'Вы успешно приобрели сертификат торговца!',
                        'flash_message_status' => 'success',
                    ]);
                }
                return redirect('distributions')->with([
                    'flash_message' => 'У Вас не хватает кликов!',
                    'flash_message_status' => 'danger',
                ]);
            }
            return redirect('distributions')->with([
                'flash_message' => 'У Вас уже есть сертификат торговца!',
                'flash_message_status' => 'warning',
            ]);
        }
        return redirect('distributions')->with([
            'flash_message' => 'Ваш аккаунт не подтвержден!',
            'flash_message_status' => 'danger',
        ]);
    }

    public function buy_cert_cry()
    {
        //Только для подтвержденных аккаунтов
        if (Auth::user()->steamid && Auth::user()->confirm_email) {
            $user = User::where('id', \Auth::id())->first();

            if ($user->isTrader == 0) {
                if ($user->crystals >= Config::get('main.price_cert_crystals')) {
                    User::where('id', \Auth::id())->update([
                        'clicks' => $user->crystals - Config::get('main.price_cert_crystals'),
                        'isTrader' => 1,
                    ]);

                    return redirect('distributions')->with([
                        'flash_message' => 'Вы успешно приобрели сертификат торговца!',
                        'flash_message_status' => 'success',
                    ]);
                }
                return redirect('distributions')->with([
                    'flash_message' => 'У Вас не хватает кликов!',
                    'flash_message_status' => 'danger',
                ]);
            }
            return redirect('distributions')->with([
                'flash_message' => 'У Вас уже есть сертификат торговца!',
                'flash_message_status' => 'warning',
            ]);
        }
        return redirect('distributions')->with([
            'flash_message' => 'Ваш аккаунт не подтвержден!',
            'flash_message_status' => 'danger',
        ]);
    }

    public function create()
    {
        return view('distributions.create');
    }

    public function update(Request $request, SteamHelper $steam, SlugHelper $slug)
    {
        $this->validate($request, [
            'game_id' => 'required|integer',
            'price' => 'required|integer',
            'data' => 'required',
            'type' => 'required',
            'region' => 'required|integer',
            'players' => 'required|integer|min:10|max:500',
        ]);
        //level distr
        if ($request['level'] == null OR $request['level'] == 1) {
            $level = 1;
            $price = abs($request->input('price') / $request->input('players')) + ($request->input('price') / $request->input('players') * 0.1);
        } elseif ($request['level'] == 2) {
            $level = 2;
            $price = abs($request->input('price') / $request->input('players'));
        }

        if ($steam->addDistributionToDB($request->input('game_id'), $request->input('type'))) {

            $steam = $steam->addDistributionToDB($request->input('game_id'), $request->input('type'));
            if ($request->input('type') == 1) {
                $data_id = $steam->subid;
            } elseif ($request->input('type') == 2) {
                $data_id = $steam->appid;
            }

            //slug
            $slug = $slug->makeSlugFromTitle(Distribution::class, $steam->name);

            Distribution::create([
                'name' => '',
                'level' => $level,
                'players' => $request->input('players'),
                'price' => $price,
                'type' => $request->input('type'), //пак 1, игра 2, предмет 3
                'status' => 0,
                'user_id' => Auth::id(),
                'user_winner_id' => 0,
                'data_name' => $steam->name,
                'data_image' => $steam->header_image,
                'data_id' => $data_id,
                'data_key' => $request->input('data'),
                'data_region' => $request->input('region'),
                'slug' => $slug,
                'description' => $request->input('description'),
                'topped_at' => Carbon::now()->toDateTimeString(),
            ]);

            return redirect('distributions/' . $slug)->with([
                'flash_message' => 'Вы успешно создали раздачу ' . $steam->name,
                'flash_message_status' => 'success',
            ]);
        } else return redirect('distributions')->with([
            'flash_message' => 'Невозможно создать раздачу, такой игры нет в Steam!',
            'flash_message_status' => 'danger',
        ]);
    }

    public function join($slug)
    {
        $distribution = Distribution::where('slug', $slug)->where('status', 0)->first();

        //Только для подтвержденных аккаунтов
        if (Auth::user()->steamid && Auth::user()->confirm_email) {

            //Только для аккаунтов 5 уровня
            if (Auth::user()->steam_level >= 5 AND $distribution->level == 1 OR $distribution->level == 2) {

                if ($distribution) {
                    //считаем количество участия
                    $play = Player::where('distribution_id', $distribution->id)->where('user_id', Auth::id())->count();

                    $user = User::where('id', Auth::id())->first();

                    if ($distribution->user_id != Auth::id()) {

                        if ($play == 0) {
                            //узнаем валюту
                            if ($distribution->level == 1) {
                                $coins_count = $user->clicks;
                                $coin_name = 'Кликов';
                                $coin = 'clicks';
                                $coins_all_commission = ($distribution->players * $distribution->price - $distribution->players * $distribution->price * 0.1);
                            } elseif ($distribution->level == 2) {
                                $coins_count = $user->crystals;
                                $coin_name = 'Кристаллов';
                                $coin = 'crystals';
                                $coins_all_commission = $distribution->players * $distribution->price;
                            }

                            if ($coins_count >= $distribution->price) {
                                User::where('id', \Auth::id())->update([
                                    $coin => $coins_count - $distribution->price,
                                ]);
                                Distribution::where('id', $distribution->id)->update([
                                    'joined_players' => $distribution->joined_players + 1,
                                ]);
                                $player = Player::create([
                                    'distribution_id' => $distribution->id,
                                    'user_id' => Auth::id(),
                                ]);
                                if ($player) {
                                    if (Player::where('distribution_id', $distribution->id)->count() == $distribution->players) {
                                        $random_user = Player::where('distribution_id', $distribution->id)
                                            ->inRandomOrder()
                                            ->first();
                                        Distribution::where('id', $distribution->id)->update([
                                            'user_winner_id' => $random_user->user_id,
                                            'status' => 1,
                                        ]);

                                        User::where('id', $distribution->user_id)->increment($coin, $coins_all_commission);

                                        //event
                                        Event::create([
                                            'user_id' => $distribution->user_id,
                                            'image' => $distribution->data_image,
                                            'text' => 'Ваш розыгрыш ' . $distribution->data_name . ' закончен! Вы заработали ' . $coins_all_commission . ' ' . $coin_name,
                                            'url' => url('distributions/' . $distribution->slug),
                                            'type' => 'game',
                                        ]);

                                        //event 2
                                        Event::create([
                                            'user_id' => $random_user->user_id,
                                            'image' => $distribution->data_image,
                                            'text' => 'Вы победили в розыгрыше  ' . $distribution->data_name,
                                            'url' => url('distributions/' . $distribution->slug),
                                            'type' => 'game',
                                            'data' => $distribution->data_key,
                                        ]);
                                    }
                                }
                                return redirect('distributions/' . $distribution->slug)->with([
                                    'flash_message' => 'Вы успешно приняли участие в раздаче ' . $distribution->game_name,
                                    'flash_message_status' => 'success',
                                ]);
                            } else return redirect('distributions/' . $distribution->slug)->with([
                                'flash_message' => 'У Вас не хватает ' . $coin_name . ' для участия в раздаче ' . $distribution->game_name,
                                'flash_message_status' => 'danger',
                            ]);
                        } else return redirect('distributions/' . $distribution->slug)->with([
                            'flash_message' => 'Вы уже участвуете в раздаче ' . $distribution->game_name,
                            'flash_message_status' => 'danger',
                        ]);
                    } else return redirect('distributions/' . $distribution->slug)->with([
                        'flash_message' => 'Вы не можете участвовать в своей раздаче',
                        'flash_message_status' => 'danger',
                    ]);
                } else return redirect('/');
            } else return redirect('distributions/' . $distribution->slug)->with([
                'flash_message' => 'Ваш Steam-аккаунт должен быть не менее 5 уровня.',
                'flash_message_status' => 'danger',
            ]);
        } else return redirect('distributions/' . $distribution->slug)->with([
            'flash_message' => 'Вам необходимо подтвердить аккаунт',
            'flash_message_status' => 'danger',
        ]);
    }

    public function cancel($slug)
    {
        $distribution = Distribution::where('slug', $slug)
            ->where('status', 0)
            ->first();
        if ($distribution) {
            if ($distribution->user_id == Auth::id()) {
                //узнаем валюту
                if ($distribution->level == 1) {
                    $coins_count = ($distribution->price - $distribution->price * 0.2);
                    $coin_name = 'Клики';
                    $coin_name_event = 'Клик.';
                    $coin = 'clicks';
                } elseif ($distribution->level == 2) {
                    $coins_count = $distribution->price;
                    $coin_name = 'Кристаллы';
                    $coin_name_event = 'Крис.';
                    $coin = 'crystals';
                }

                $players = Player::where('distribution_id', $distribution->id)
                    ->get();
                if (count($players)) {
                    foreach ($players as $player) {
                        Distribution::where('id', $distribution->id)
                            ->update([
                                'status' => '2',
                            ]);

                        User::where('id', $player->user_id)->increment($coin, $coins_count);

                        //event
                        Event::create([
                            'user_id' => $player->user_id,
                            'image' => $distribution->data_image,
                            'text' => 'Торговец отменил раздачу  ' . $distribution->data_name . 'и вернул Вам ' . $coins_count . ' ' . $coin_name_event,
                            'url' => url('distributions/' . $distribution->slug),
                            'type' => 'game',
                        ]);

                    }
                } else {
                    Distribution::where('id', $distribution->id)
                        ->update([
                            'status' => '2',
                        ]);
                }
                return redirect('distributions/' . $distribution->slug)
                    ->with([
                        'flash_message' => 'Вы успешно отменили раздачу и вернули ' . $coin_name . ' участникам!',
                        'flash_message_status' => 'success',
                    ]);

            }
            return redirect('/');
        }
        return redirect('/');
    }

    public function show($slug)
    {
        $distribution = Distribution::where('slug', $slug)->first();
        if ($distribution->type == 1) {
            $distribution->data_type = 'sub';
        } elseif ($distribution->type == 2) {
            $distribution->data_type = 'app';
        }
        $check_player = $distribution->players_list->where('user_id', Auth::id())->first();

        return view('distributions.show', compact('distribution', 'check_player'));
    }

    public function comment(Request $request, $slug)
    {
        $distribution = Distribution::where('slug', $slug)->first();
        if ($distribution->user_winner_id == Auth::id() && $distribution->comment == null) {
            Distribution::where('id', $distribution->id)
                ->update([
                    'comment' => $request['comment'],
                    'rating' => ($request['rating']),
                ]);

            User::where('id', $distribution->user_id)->increment('rating', $request['rating']);
            return redirect('distributions/' . $distribution->slug)
                ->with([
                    'flash_message' => 'Вы успешно добавили комментраий!',
                    'flash_message_status' => 'success',
                ]);
        }
        return redirect('/');
    }

    public function up($slug)
    {
        $distribution = Distribution::where('slug', $slug)->first();

        if ($distribution->user_id == Auth::id()) {
            $user = User::where('id', $distribution->user_id)->first();
            //узнаем валюту
            if ($distribution->level == 1) {
                $coins_count = $user->clicks;
                $coin = 'clicks';
                $price = 10;
                $coin_name = 'Кликов';
            } elseif ($distribution->level == 2) {
                $coins_count = $user->crystals;
                $coin = 'crystals';
                $price = 1;
                $coin_name = 'Кристаллов';
            }

            if (Auth::id() == 1 OR Auth::id() != 1 AND $coins_count >= $price) {
                $distribution_update = Distribution::where('id', $distribution->id)
                    ->update([
                        'topped_at' => Carbon::now()->toDateTimeString(),
                    ]);
                if ($distribution_update) {
                    if (Auth::id() != 1) {
                        User::where('id', \Auth::id())->update([
                            $coin => $coins_count - $price,
                        ]);
                    }
                    return redirect('distributions/'.$distribution->slug)
                        ->with([
                            'flash_message' => 'Вы успешно подняли свою раздачу!',
                            'flash_message_status' => 'success',
                        ]);
                }
            }
            return redirect('distributions/'.$distribution->slug)
                ->with([
                    'flash_message' => 'У Вас не хватает '.$coin_name,
                    'flash_message_status' => 'danger',
                ]);
        }

    }
}
