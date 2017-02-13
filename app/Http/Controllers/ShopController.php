<?php

namespace App\Http\Controllers;

use App\Helpers\SteamHelper;
use Illuminate\Http\Request;
use DB;

class ShopController extends Controller
{
    public function index () {
        return view('shop.index');
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
}
