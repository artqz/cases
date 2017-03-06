<?php

namespace App\Http\Controllers;

use App\Game;
use App\Helpers\SteamHelper;
use App\Item;
use App\User;
use Illuminate\Http\Request;
use \Config;

class AdminController extends Controller
{
    public function index ()
    {
        $items_count = Item::count();
        $games_count = Game::count();
        $users_count = User::count();

        return view('admin.index', compact('items_count', 'games_count', 'users_count'));
    }


    public function index_items ()
    {
        $items = Item::paginate(30);

        return view('admin.items.index', compact('items'));
    }

    public function create_item () {
        return view('admin.items.create');
    }
    public function store_item (Request $request, SteamHelper $steam)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'game_id' => 'required',
            'price' => 'required',
        ]);

        $steam->addItemToDB($request->input('game_id'), $request->input('name'), $request->input('price'));

        return redirect('admin/items')->with([
            'flash_message' => 'Вы успешно добавили предмет '. $request->input('name'),
            'flash_message_status' => 'success',
        ]);
    }
    public function edit_item ($id_item) {
        $item = Item::findOrFail($id_item);
        return view('admin.items.edit', compact('item'));
    }

    public function update_item (Request $request, $id_item)
    {
        $this->validate($request, [
            'price' => 'required',
        ]);

        $item = Item::findOrFail($id_item);

        Item::where('id', $item->id)->update([
            'price' => $request->input('price')
        ]);

        return redirect('admin/items')->with([
            'flash_message' => 'Вы успешно изменили предмет '. $item->name,
            'flash_message_status' => 'success',
        ]);
    }

    public function give_item (Request $request, $id_item)
    {
        $this->validate($request, [
            'price' => 'required',
        ]);

        $item = Item::findOrFail($id_item);

        Item::where('id', $item->id)->update([
            'status' => 2
        ]);

        return redirect('admin/items')->with([
            'flash_message' => 'Вы успешно выдали предмет '. $item->name,
            'flash_message_status' => 'success',
        ]);
    }

    public function delete_item ($id_item) {
        $item = Item::findOrFail($id_item);

        Item::where('id', $item->id)->delete();
        return redirect('admin/items')->with([
            'flash_message' => 'Вы успешно удалили предмет '. $item->name,
            'flash_message_status' => 'success',
        ]);
    }



    public function index_games ()
    {
        $games = Game::paginate(30);

        return view('admin.games.index', compact('games'));
    }

    public function create_game () {
        return view('admin.games.create');
    }
    public function store_game (Request $request, SteamHelper $steam)
    {
        $this->validate($request, [
            'game_id' => 'required',
            'price' => 'required',
            'data' => 'required',
        ]);

        $steam->addGameToDB($request->input('game_id'), $request->input('price'), $request->input('data'));

        return redirect('admin/games')->with([
            'flash_message' => 'Вы успешно добавили игру',
            'flash_message_status' => 'success',
        ]);
    }
    public function edit_game ($id_game) {
        $game = Game::findOrFail($id_game);
        return view('admin.games.edit', compact('game'));
    }

    public function update_game (Request $request, $id_game)
    {
        $this->validate($request, [
            'price' => 'required',
            'data' => 'required',
        ]);

        $game = Game::findOrFail($id_game);

        Game::where('id', $game->id)->update([
            'price' => $request->input('price'),
            'data' => $request->input('data'),
        ]);

        return redirect('admin/games')->with([
            'flash_message' => 'Вы успешно изменили игру '. $game->name,
            'flash_message_status' => 'success',
        ]);
    }

    public function delete_game ($id_game) {
        $game = Game::findOrFail($id_game);

        Game::where('id', $game->id)->delete();
        return redirect('admin/games')->with([
            'flash_message' => 'Вы успешно удалили игру '. $game->name,
            'flash_message_status' => 'success',
        ]);
    }


    public function index_users ()
    {
        $users = User::paginate(30);

        return view('admin.users.index', compact('users'));
    }

    public function edit_user ($id_user) {
        $user = User::findOrFail($id_user);

        return view('admin.users.edit', compact('user'));
    }

    public function update_user (Request $request, $id_user)
    {
        $user = User::findOrFail($id_user);

        $this->validate($request, [
            'name' => 'required|max:20|min:3',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'clicks' => 'numeric',
        ]);

        User::where('id', $user->id)->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'clicks' => $request->input('clicks'),
        ]);

        return redirect('admin/users')->with([
            'flash_message' => 'Вы успешно изменили пользователя '. $user->name,
            'flash_message_status' => 'success',
        ]);
    }

    public function delete_user ($id_user) {
        $user = User::findOrFail($id_user);

        User::where('id', $user->id)->delete();
        return redirect('admin/users')->with([
            'flash_message' => 'Вы успешно удалили пользователя '. $user->name,
            'flash_message_status' => 'success',
        ]);
    }
}
