<?php

namespace App\Http\Controllers;

use App\Gift;
use App\Game;
use Illuminate\Http\Request;

class GiftsController extends Controller
{
    public function create ($id) {
        $game_id = $id;
        return view('gifts.create', compact('game_id'));
    }
    public function store (Request $request, $id) {

        $gift = Gift::create([
            'type' => $request['type_gift'],
            'link_gift' => $request['link_gift'],
            'code_gift' => $request['code_gift'],
            'pay' => 0,
        ]);

        $gift->games()->attach($id);

    }
}
