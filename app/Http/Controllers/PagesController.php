<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Game;
use App\Help;
use App\Helpers\SteamHelper;
use App\Item;
use App\Referral;
use App\Stats;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Cookie;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function index ()
    {
        Carbon::setLocale('ru');
        $stats =  Stats::all();
        $news = Channel::with('themes')->where('slug', 'novosti')->first();
        
        return view('pages.start', compact('stats', 'news'));

    }

    public function index_referral ()
    {
        return view('pages.referral');
    }

    public function index_profile ()
    {
        $referral_clicks = Referral::where('user_ref_id', Auth::id())->sum('clicks');
        $referral_count = User::where('user_ref_id', Auth::id())->count();

        return view('pages.profile.index', compact('referral_clicks', 'referral_count'));
    }

    public function edit_tradeoffer ()
    {
        return view('pages.profile.edit');
    }
    public function update_tradeoffer (Request $request)
    {
        User::where('id', Auth::id())->update([
            'tradeoffer' => $request->input('tradeoffer'),
        ]);

        return redirect('profile')->with([
            'flash_message' => 'Вы успешно изменили свою ссылку на обмен',
            'flash_message_status' => 'success',
        ]);
    }
    public function update_steam (Request $request, SteamHelper $steam)
    {
        //$this->validate($request, [
        //    'g-recaptcha-response' => 'required|recaptcha',
        //]);

        dd($steam->getSteamAccountInfo(Auth::user()->steamid));

        return redirect('profile')->with([
            'flash_message' => 'Вы успешно обновили информацию своего Steam-аккаунта',
            'flash_message_status' => 'success',
        ]);
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
        $helps = Help::all();

        return view('pages.help', compact('helps'));
    }
    public function index_rules ()
    {
        return view('pages.rules');
    }
}
