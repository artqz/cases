<?php

namespace App\Http\Controllers;

use App\Game;
use App\Item;
use App\Referral;
use App\Stats;
use App\User;
use App\Play;
use Illuminate\Http\Request;
use Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class PagesController extends Controller
{
    public function index ()
    {

        $stats =  Stats::all();


        return view('pages.start', compact('stats'));

    }

    public function index_referral ()
    {
        return view('pages.referral');
    }

    public function index_profile ()
    {
        $referral_clicks = Referral::where('user_ref_id', Auth::id())->sum('clicks');
        $referral_count = User::where('user_ref_id', Auth::id())->count();
        return view('pages.profile', compact('referral_clicks', 'referral_count'));
    }

    public function index_my_games ()
    {
        $games = Game::where('user_id', Auth::id())->paginate(20);
        return view('pages.mygames', compact('games'));
    }

    public function index_my_items ()
    {
        $items = Item::where('user_id', Auth::id())->paginate(20);
        return view('pages.myitems', compact('items'));
    }

    public function index_help ()
    {
        return view('pages.help');
    }
}
