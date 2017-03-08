<?php

namespace App\Http\Controllers;

use App\Game;
use App\Helpers\SteamHelper;
use App\Item;
use App\User;
use App\Stats;
use Config;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Cache;
use Session;

class ShopController extends Controller
{
    public function index () {
        $games =  Game::where('status', 0)->orderBy('price', 'desc')->limit(4)->get();
 
        $items = Item::where('status', 0)->orderBy('price', 'desc')->limit(4)->get();

        $last_buy_items = Item::where('status', 1)->orderBy('updated_at', 'desc')->orwhere('status', 2)->limit(15)->get();
        $last_buy_games = Game::where('status', 2)->orderBy('updated_at', 'desc')->limit(15)->get();
        return view('shop.index', compact('games', 'items', 'last_buy_items', 'last_buy_games'));
    }


    public function index_items ($id_game = null) {

        if($id_game) {
            $items = Item::where('appid', $id_game)->where('status', 0)->orderBy('price', 'desc')->paginate(Config::get('main.items_per_page'));
        }
        else {
            $items = Item::where('status', 0)->orderBy('price', 'desc')->paginate(Config::get('main.items_per_page'));
        }
        $categories = Item::groupBy('appid')->get();

        return view('shop.items.index', compact('items','last_buy_items', 'categories'));
    }
    public function create_item () {
        return view('shop.items.create');
    }
    public function store_item (Request $request, SteamHelper $steam) {
        $this->validate($request, [
            'name' => 'required|max:255',
            'game_id' => 'required',
            'price' => 'required',
        ]);

        $steam->addItemToDB($request->input('game_id'), $request->input('name'), $request->input('price'));

        return redirect('/shop/items');


    }
    public function buy_item ($id_item) {
        $user = User::where('id', \Auth::id())->first();
        $item = Item::where('id', $id_item)->where('status', 0)->first();
        if ($item) {
            if ($user->clicks >= $item->price) {
                User::where('id', \Auth::id())->update([
                    'clicks' => $user->clicks - $item->price,
                ]);
                //Записываем статистику
                Stats::where('name', 'items')->increment('value', 1);
                Item::where('id', $id_item)->update([
                    'status' => 1,
                    'hashcode' => md5(\Auth::id() + $id_item +time()),
                    'user_id' => \Auth::id()]);
                return redirect('/shop/items')->with([
                    'flash_message' => 'Вы успешно купили предмет '. $item->name,
                    'flash_message_status' => 'success',
                ]);
            }

        }
        else {
            return redirect('/shop/items');
        }

        return redirect('/shop/items')->with([
            'flash_message' => 'У вас не хватает денег!',
            'flash_message_status' => 'danger',
        ]);
    }

    public function index_games (SteamHelper $steam) {
        $games = Game::where('status', 0)->orderBy('price', 'desc')->paginate(Config::get('main.games_per_page'));
        $last_buy_games = Game::where('status', 1)->get();

        return view('shop.games.index', compact('games','last_buy_games'));
    }
    public function create_game () {
        return view('shop.games.create');
    }
    public function store_game (Request $request, SteamHelper $steam) {
        $this->validate($request, [
            'game_id' => 'required',
            'price' => 'required',
            'data' => 'required',
        ]);

        $steam->addGameToDB($request->input('game_id'), $request->input('price'), $request->input('data'));

        return redirect('shop/games')->with([
            'flash_message' => 'Вы успешно добавили игру',
            'flash_message_status' => 'success',
        ]);;


    }
    public function buy_game ($id_game) {
        $user = User::where('id', \Auth::id())->first();
        $game = Game::where('id', $id_game)->where('status', 0)->first();
        if ($game) {
            if ($user->clicks >= $game->price) {
                User::where('id', \Auth::id())->update([
                    'clicks' => $user->clicks - $game->price,
                ]);
                //Записываем статистику
                Stats::where('name', 'games')->increment('value', 1);
                Game::where('id', $id_game)->update([
                    'status' => 2,
                    'hashcode' => md5(\Auth::id() + $id_game +time()),
                    'user_id' => \Auth::id()]);
                return redirect('/shop/games')->with([
                    'flash_message' => 'Вы успешно купили игру '. $game->name,
                    'flash_message_status' => 'success',
                ]);
            }

        }
        else {
            return redirect('/shop/games');
        }

        return redirect('/shop/games')->with([
            'flash_message' => 'У вас не хватает денег!',
            'flash_message_status' => 'danger',
        ]);
    }
}
