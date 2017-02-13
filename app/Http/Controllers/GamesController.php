<?php
/*
Ваш ключ Steam Web API
Ключ: 97E5CDC7C832E47EC6168D6F728E837E
Домен: steamclicks.ru

http://store.steampowered.com/api/appdetails?appids=570
*/

namespace App\Http\Controllers;

use App\Game;
use App\Helpers\SteamHelper;
use Illuminate\Http\Request;
use DB;

class GamesController extends Controller
{
    public function index () {
        $games = Game::with('gifts')->get();
        return view('games.index', compact('games'));
    }

    public function show ($id) {
        $game = Game::with('gifts')->findOrFail($id);
        return view('games.show', compact('game'));
    }

    public function create () {
        return view('games.create');
    }
    public function store (Request $request, SteamHelper $steam) {
        $this->validate($request, [
            'link_app' => 'required|max:255|is_link_steam',
        ]);

        $link_app = $request->input('link_app');

        $steam_id = explode('/', trim(parse_url($link_app)['path'], '/'))[1];

        if ($steam->getGame($steam_id)) {
           return redirect('/shop/game/' . $steam->getGame($steam_id)->id);
        }
        else echo 'Ooops... ;)';

    }
    
}
