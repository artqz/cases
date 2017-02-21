<?php

namespace App\Http\Controllers;

use App\Referral;
use App\User;
use App\Play;
use Illuminate\Http\Request;
use Cookie;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function index ()
    {

        $users = User::count();
        $plays = Play::count();

        return view('pages.start', compact('users', 'plays'));

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
}
