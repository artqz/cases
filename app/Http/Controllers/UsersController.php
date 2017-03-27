<?php

namespace App\Http\Controllers;

use App\Click;
use App\Game;
use App\Referral;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function show ($id_user)
    {
        Carbon::setLocale('ru');

        $user = User::where('id', $id_user)->first();

        if ($user) {
            $items = new \stdClass();
            $items->user = $user;
            $items->clicks = Click::where('user_id', $user->id)->orderBy('created_at', 'desc')->limit(30)->get();
            $items->games = Game::where('user_id', $user->id)->orderBy('created_at', 'desc')->limit(30)->get();
            $items->referrals_count = Referral::where('user_ref_id', $user->id)->count();

            return view('users.show', compact('items'));
        }
    }
}
