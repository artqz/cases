<?php

namespace App\Http\Controllers;

use App\Distribution;
use App\Helpers\SteamHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DistributionsController extends Controller
{
    public function index()
    {
        $distributions = Distribution::paginate(20);

        return view('distributions.index', compact('distributions'));
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
                'price' => $request->input('price'),
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
            dd($distribution);
        }
        else return redirect('/');
    }
}
