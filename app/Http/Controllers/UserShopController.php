<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Http\Request;

class UserShopController extends Controller
{
    public function index_games()
    {
        $games = Game::orderBy('created_at', 'desc')
            ->get(['name']);

        return response([
            'games' => $games
        ])
            ->json();
    }

    public function show_game()
    {

    }

    public function create_game()
    {
        $form = Game::form();

        return response()
            ->json(['form' => $form]);
    }

    public function store_game(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255'
        ]);

        $game = new Game($request->all());

        $request->user()->games()->save($game);

        return response()
            ->json([
                'saved' => true,
                'id' => $game->id,
                'message' => 'Вы успешно добавили игру!'
            ]);
    }

    public function create_item()
    {
         return view('shop.users.items.create');
    }
}
