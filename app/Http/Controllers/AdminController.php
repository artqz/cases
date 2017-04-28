<?php

namespace App\Http\Controllers;

use App\Game;
use App\Help;
use App\Helpers\SteamHelper;
use App\Item;
use App\Message;
use App\Stats;
use App\User;
use Illuminate\Http\Request;
use \Config;
use App\Helpers\DataViewer;

class AdminController extends Controller
{
    public function index ()
    {

        $items = new \stdClass();
        $items->items_count = Item::count();
        $items->games_count = Game::count();
        $items->users_count = User::count();
        $items->messages_count = Message::count();
        $items->helps_count = Help::count();


        return view('admin.index', compact('items'));
    }

    public function index_items (Request $request)
    {
        if ($request['filter'] == 'pending') {
            $users = User::where('status', 1)->paginate(30);
        }
        else {
            $items = Item::paginate(30);
        }

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
    public function search_item (Request $request)
    {
        $items = Item::join('users', 'items.user_id', '=', 'users.id')
            ->selectRaw('items.name as name, items.id as id, items.price as price, items.status as status, items.user_id as user_id, items.hashcode as hashcode, items.created_at as created_at')
            ->where('items.name', 'LIKE', '%'.$request['q'].'%')
            ->orWhere('users.name', 'LIKE', '%'.$request['q'].'%')
            ->orderBy('created_at', 'desc')
            ->paginate(30);
        $items->appends(['q' => $request['q']]);

        return view('admin.items.index', compact('items'));
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


    public function index_users (Request $request)
    {
        if ($request['filter'] == 'clicks') {
            $users = User::orderBy('clicks', 'desc')->paginate(30);
        }
        elseif ($request['filter'] == 'crystals') {
            $users = User::orderBy('crystals', 'desc')->paginate(30);
        }
        else {
            $users = User::paginate(30);
        }

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
            'crystals' => 'numeric',
        ]);

        User::where('id', $user->id)->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'clicks' => $request->input('clicks'),
            'crystals' => $request->input('crystals'),
            'isBanned' => $request->input('isBanned'),
            'isTrader' => $request->input('isTrader'),
            'isSpamer' => $request->input('isSpamer'),
        ]);

        return redirect('admin/users')->with([
            'flash_message' => 'Вы успешно изменили пользователя '. $user->name,
            'flash_message_status' => 'success',
        ]);
    }
    public function search_user (Request $request)
    {
        $users = User::where('name', 'LIKE', '%'.$request['q'].'%')
            ->orWhere('email', 'LIKE', '%'.$request['q'].'%')
            ->orWhere('id', $request['q'])
            ->orWhere('ip_address', $request['q'])
            ->paginate(30);
        $users->appends(['q' => $request['q']]);

        return view('admin.users.index', compact('users'));
    }

    public function create_reward_hundred () {
        return view('admin.users.reward_hundred');
    }

    public function update_reward_hundred (Request $request) {

        $users = User::orderBy('updated_at', 'desc')
            ->inRandomOrder()
            ->limit(100)
            ->get();
        $this->validate($request, [
            'reward' => 'numeric',
        ]);

        foreach ($users as $user) {
            User::where('id', $user->id)->increment('clicks', $request->input('reward'));
            User::where('id', $user->id)->increment('all_clicks', $request->input('reward'));
            //Записываем статистику
            Stats::where('name', 'clicks')->increment('value', $request->input('reward'));
        }

        return redirect('admin/users')->with([
            'flash_message' => 'Вы успешно наградили 100 пользователей',
            'flash_message_status' => 'success',
        ]);
    }

    public function create_reward ($id_user) {
        $user = User::findOrFail($id_user);

        return view('admin.users.reward', compact('user'));
    }

    public function update_reward (Request $request, $id_user) {

        $user = User::findOrFail($id_user);

        $this->validate($request, [
            'reward' => 'numeric',
        ]);

        User::where('id', $user->id)->increment('clicks', $request->input('reward'));
        User::where('id', $user->id)->increment('all_clicks', $request->input('reward'));
        //Записываем статистику
        Stats::where('name', 'clicks')->increment('value', $request->input('reward'));

        return redirect('admin/users')->with([
            'flash_message' => 'Вы успешно наградили пользователя '. $user->name,
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



    public function index_messages ()
    {
        $messages = Message::paginate(30);

        return view('admin.messages.index', compact('messages'));
    }

    public function delete_message ($id_message) {
        $message = Message::findOrFail($id_message);

        Message::where('id', $message->id)->delete();
        return redirect('admin/messages')->with([
            'flash_message' => 'Вы успешно удалили сообщение '. $message->text,
            'flash_message_status' => 'success',
        ]);
    }


    public function index_helps ()
    {
        $helps = Help::paginate(30);

        return view('admin.helps.index', compact('helps'));
    }

    public function create_help () {
        return view('admin.helps.create');
    }

    public function store_help (Request $request, SteamHelper $steam)
    {
        $this->validate($request, [
            'name' => 'required',
            'text' => 'required',
            'position' => 'integer',
        ]);

        Help::create([
            'name' => $request['name'],
            'text' => $request['text'],
            'position' => $request['position'],
        ]);

        return redirect('admin/helps')->with([
            'flash_message' => 'Вы успешно добавили хелпер',
            'flash_message_status' => 'success',
        ]);
    }

    public function edit_help ($id_help) {
        $help = Help::where('id', $id_help)->first();

        return view('admin.helps.edit', compact('help'));
    }

    public function update_help (Request $request, $id_help)
    {
        $help = Help::where('id', $id_help)->first();

        $this->validate($request, [
            'name' => 'required',
            'text' => 'required',
            'position' => 'integer',
        ]);

        Help::where('id', $help->id)->update([
            'name' => $request['name'],
            'text' => $request['text'],
            'position' => $request['position'],
        ]);

        return redirect('admin/helps')->with([
            'flash_message' => 'Вы успешно изменили хелпер',
            'flash_message_status' => 'success',
        ]);
    }

    public function delete_help ($id_message) {
        $help = Help::where('id', $id_help)->first();

        Help::where('id', $help->id)->delete();
        return redirect('admin/helps')->with([
            'flash_message' => 'Вы успешно удалили хелпер '. $help->name,
            'flash_message_status' => 'success',
        ]);
    }
}
