<?php

namespace App\Http\Controllers;

use App\Distribution;
use App\Event;
use App\Helpers\SteamHelper;
use App\Player;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Config;

class DistributionsController extends Controller
{
    public function index()
    {
        Carbon::setLocale('ru');
        $distributions = Distribution::paginate(20);

        return view('distributions.index', compact('distributions'));
    }

    /**
     * @return string
     */
    public function buy_cert ()
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

    public function create()
    {
        return view('distributions.create');
    }

    public function update(Request $request, SteamHelper $steam)
    {
        $this->validate($request, [
            'game_id' => 'required|integer',
            'price' => 'required|integer',
            'data' => 'required',
            'type' => 'required',
            'players' => 'required|integer',
        ]);

        if ($steam->addDistributionToDB($request->input('game_id'), $request->input('type'))) {

            $steam = $steam->addDistributionToDB($request->input('game_id'), $request->input('type'));
            if($request->input('type') == 1) {
                $data_id = $steam->subid;
            }
            elseif ($request->input('type') == 2) {
                $data_id = $steam->appid;
            }
            Distribution::create([
                'name' => '',
                'players' => $request->input('players'),
                'price' => abs($request->input('price')/$request->input('players'))+($request->input('price')/$request->input('players')*0.1),
                'type' => $request->input('type'), //пак 1, игра 2, предмет 3
                'status' => 0,
                'user_id' => Auth::id(),
                'user_winner_id' => 0,
                'data_name' => $steam->name,
                'data_image' => $steam->header_image,
                'data_id' => $data_id,
                'data_key' => $request->input('data'),
            ]);

            return redirect('distributions')->with([
                'flash_message' => 'Вы успешно создали раздачу '.$steam->name,
                'flash_message_status' => 'success',
            ]);
        }

        else return redirect('distributions')->with([
            'flash_message' => 'Невозможно создать раздачу, такой игры нет в Steam!',
            'flash_message_status' => 'danger',
        ]);
    }

    public function join($id_distribution)
    {
        $distribution = Distribution::where('id', $id_distribution)->where('status', 0)->first();

        //Только для подтвержденных аккаунтов
        if (Auth::user()->steamid && Auth::user()->confirm_email) {

            if ($distribution) {
                //считаем количество участия
                $play = Player::where('distribution_id', $distribution->id)->where('user_id', Auth::id())->count();

                $user = User::where('id', Auth::id())->first();

                if ($distribution->user_id != Auth::id()) {

                    if ($play == 0) {
                        if ($user->clicks >= $distribution->price) {
                            User::where('id', \Auth::id())->update([
                                'clicks' => $user->clicks - $distribution->price,
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

                                    //event
                                    Event::create([
                                        'user_id' => $random_user->user_id,
                                        'image' => $distribution->data_image,
                                        'text' => 'Вы победили в розыгрыше  '.$distribution->data_name,
                                        'type' => 'game',
                                    ]);
                                }
                            }
                            return redirect('distributions/' . $distribution->id)->with([
                                'flash_message' => 'Вы успешно приняли участие в раздаче ' . $distribution->game_name,
                                'flash_message_status' => 'success',
                            ]);
                        } else return redirect('distributions/' . $distribution->id)->with([
                            'flash_message' => 'У Вас не хватает кликов для участия в раздаче ' . $distribution->game_name,
                            'flash_message_status' => 'danger',
                        ]);
                    } else return redirect('distributions/' . $distribution->id)->with([
                        'flash_message' => 'Вы уже участвуете в раздаче ' . $distribution->game_name,
                        'flash_message_status' => 'danger',
                    ]);
                } else return redirect('distributions/' . $distribution->id)->with([
                    'flash_message' => 'Вы не можете участвовать в своей раздаче',
                    'flash_message_status' => 'danger',
                ]);
            } else return redirect('/');
        }
        else return redirect('distributions/' . $distribution->id)->with([
            'flash_message' => 'Вам необходимо подтвердить аккаунт',
            'flash_message_status' => 'danger',
        ]);
    }

    public function show ($id_distribution) {
        $distribution = Distribution::where('id', $id_distribution)->first();
        if ($distribution->type == 1) {
            $distribution->data_type = 'sub';
        }
        elseif ($distribution->type == 2) {
            $distribution->data_type = 'app';
        }
        $check_player = $distribution->players_list->where('user_id', Auth::id())->first();

        return view('distributions.show', compact('distribution', 'check_player'));
    }
}
