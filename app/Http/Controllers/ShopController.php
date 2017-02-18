<?php

namespace App\Http\Controllers;

use App\Game;
use App\Helpers\SteamHelper;
use App\Item;
use App\User;
use Illuminate\Http\Request;
use DB;

class ShopController extends Controller
{
    public function index () {
        $games = Game::where('status', 0)->orderBy('price', 'desc')->limit(4)->get();
        $items = Item::where('status', 0)->orderBy('price', 'desc')->limit(4)->get();
        return view('shop.index', compact('games', 'items'));
    }

    public function create_game1 () {
        return view('shop.create_game');
    }
    public function store_game1 (Request $request, SteamHelper $steam) {
        $this->validate($request, [
            'link_app' => 'required|max:255|is_link_steam',
            'link_gift' => 'required',
        ]);
        $link_app = $request->input('link_app');
        $link_gift = $request->input('link_gift');

        $steam_id = explode('/', trim(parse_url($link_app)['path'], '/'))[1];

        if ($steam->getGame($steam_id)) {
            $game_id = DB::table('shop')->insertGetId([
                'steam_game_id' => $steam_id,
                'steam_item_id' => 0,
                'link' => $link_gift,
                'pay' => 0,
            ]);

            return redirect('/shop/game/' . $game_id);
        }

    }

    public function show_game1 ($id) {
        return view('shop.show');
    }

    public function index_items (SteamHelper $steam) {
        $items = Item::where('status', 0)->orderBy('price', 'desc')->paginate(20);
        $last_buy_items = Item::where('status', 1)->get();

        return view('shop.items.index', compact('items','last_buy_items'));
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
        $item = Item::where('id', $id_item)->update(['status' => 1, 'hashcode' => md5(\Auth::id() + $id_item +time()), 'user_id' => \Auth::id()]);

        return redirect('/shop/items');
    }

    public function index_games (SteamHelper $steam) {
        $games = Game::where('status', 0)->orderBy('price', 'desc')->paginate(20);
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
        ]);

        $steam->addGameToDB($request->input('game_id'), $request->input('price'));

        return redirect('shop/games');


    }
    public function buy_game ($id_game) {
        $item = Game::where('id', $id_game)->update(['status' => 2, 'hashcode' => md5(\Auth::id() + $id_game +time()), 'user_id' => \Auth::id()]);

        return redirect('/shop/games');
    }
}
