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
            $items->referrals_count = User::where('created_at', '<=', Carbon::now())
                ->where('created_at', '>=', Carbon::now()->subWeek())
                ->where('user_ref_id', '!=', 0)
                ->where('confirm_email', '=', 1)
                ->where('steamid', '!=', 0)
                ->selectRaw('count(id) AS referrals, user_ref_id AS user_id')
                ->selectRaw('count(user_ref_id)')
                ->groupBy('user_ref_id')
                ->count();

            return view('users.show', compact('items'));
        }
    }
}
