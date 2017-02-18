<?php

namespace App\Http\Controllers;

use App\Helpers\SteamHelper;
use App\Item;
use App\User;
use Illuminate\Http\Request;
use DB;

class ShopController extends Controller
{
    public function index () {
        $items = Item::where('status', 0)->get();
        return view('shop.index', compact('items'));
    }

    public function create_game () {
        return view('shop.create_game');
    }
    public function store_game (Request $request, SteamHelper $steam) {
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

    public function show_game ($id) {
        return view('shop.show');
    }

    public function index_items (SteamHelper $steam) {
        $items = Item::where('status', 0)->get();
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
        $item = Item::where('id', $id_item)->update(['status' => 1, 'hashcode' => md5(\Auth::id() + $id_item), 'user_id' => \Auth::id()]);

        return redirect('/shop/items');
    }
}
