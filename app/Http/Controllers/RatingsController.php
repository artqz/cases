<?php

namespace App\Http\Controllers;

use App\Click;
use App\Referral;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RatingsController extends Controller
{
    public function index () {
        $clickers = Click::where('created_at', '<=', Carbon::now())
            ->where('created_at', '>=', Carbon::now()->subWeek())
            ->selectRaw('count(clicks) AS clicks, user_id')
            ->groupBy('user_id')
            ->orderBy('clicks', 'desc')
            ->limit(10)
            ->get();

        $referrers = User::where('created_at', '<=', Carbon::now())
            ->where('created_at', '>=', Carbon::now()->subWeek())
            ->where('user_ref_id', '!=', 0)
            ->where('confirm_email', '=', 1)
            ->where('isBanned', '=', 0)
            ->where('steamid', '!=', 0)
            ->selectRaw('count(id) AS referrals, user_ref_id AS user_id')
            ->selectRaw('count(user_ref_id)')
            ->selectRaw('(SELECT isBanned FROM users WHERE id = user_id) AS isBanned')
            ->groupBy('user_ref_id')
            ->orderBy('referrals', 'desc')
            ->where('isBanned', 0)
            ->limit(10)
            ->get();

        return view('ratings.index', compact('clickers', 'referrers'));
    }
}
