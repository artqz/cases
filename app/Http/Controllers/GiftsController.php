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
            'link' => $request['link_gift'],
            'pay' => 0,
            'game_id' => 0,
        ]);

        $gift->games()->attach($id);

    }
}
