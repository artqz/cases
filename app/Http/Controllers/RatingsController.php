<?php

namespace App\Http\Controllers;

use App\Click;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RatingsController extends Controller
{
    public function index () {
        $clickers = Click::where('created_at', '<=', Carbon::now())
            ->where('created_at', '>=', Carbon::now()->subWeek())
            ->selectRaw('sum(clicks) AS clicks, user_id')
            ->groupBy('user_id')
            ->orderBy('clicks', 'desc')
            ->limit(10)
            ->get();

        $referrers = User::where('created_at', '<=', Carbon::now())
            ->where('created_at', '>=', Carbon::now()->subWeek())
            ->where('user_ref_id', '!=', 0)
            ->selectRaw('count(id) AS referrals, user_ref_id AS user_id')
            ->selectRaw('count(user_ref_id)')
            ->groupBy('user_ref_id')
            ->orderBy('referrals', 'desc')
            ->limit(10)
            ->get();

        return view('ratings.index', compact('clickers', 'referrers'));
    }
}
