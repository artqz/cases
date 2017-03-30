<?php

namespace App\Http\Controllers;

use App\Distribution;
use App\Helpers\SteamHelper;
use App\Player;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Config;

class DistributionsController extends Controller
{
    public function index()
    {
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
            'players' => 'required|integer',
        ]);
        
        if ($steam->addDistributionToDB($request->input('game_id'))) {

            $steam = $steam->addDistributionToDB($request->input('game_id'));

            Distribution::create([
                'name' => '',
                'players' => $request->input('players'),
                'price' => ($request->input('price')/$request->input('players'))+($request->input('price')/$request->input('players')*0.1),
                'type' => 1, //игра 1, предмет 2
                'status' => 0,
                'user_id' => Auth::id(),
                'user_winner_id' => 0,
                'game_name' => $steam->name,
                'game_image' => $steam->header_image,
                'game_id' => $steam->appid,
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
        $distribution = Distribution::where('id', $id_distribution)->first();
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
                            }
                        }
                        return redirect('distributions')->with([
                            'flash_message' => 'Вы успешно приняли участие в раздаче ' . $distribution->game_name,
                            'flash_message_status' => 'success',
                        ]);
                    } else return redirect('distributions')->with([
                        'flash_message' => 'У Вас не хватает кликов для участия в раздаче ' . $distribution->game_name,
                        'flash_message_status' => 'danger',
                    ]);
                } else return redirect('distributions')->with([
                    'flash_message' => 'Вы уже участвуете в раздаче ' . $distribution->game_name,
                    'flash_message_status' => 'danger',
                ]);
            }
            else return redirect('distributions')->with([
                'flash_message' => 'Вы не можете участвовать в своей раздаче',
                'flash_message_status' => 'danger',
            ]);
        }
        else return redirect('/');
    }

    public function show ($id_distribution) {
        $distribution = Distribution::where('id', $id_distribution)->first();

        return view('distributions.show', compact('distribution'));
    }
}
