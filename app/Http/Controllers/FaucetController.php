<?php

namespace App\Http\Controllers;

use App\Play;
use Illuminate\Http\Request;
use DB;
use Auth;

class FaucetController extends Controller
{
    public function index ()
    {
        if (Auth::user()) $user_id = Auth::user()->getAttribute('id');
        else $user_id = 0;
        $plays = DB::table('plays')->where('user_id', $user_id)->latest()->first();
        if (Auth::user()) {
            $xrpRefs = DB::table('plays')->where('user_id', $user_id)->where('type', 'ref')->sum('count');
            $countRefs = DB::table('users')->where('user_ref_id', $user_id)->count();
        }
        else {
            $xrpRefs = 0;
            $countRefs = 0;
        }
        $period = 0.05 * 60 * 60;
        //if ($plays->created_at) $plays = 0;
        //$tiktak = (time() - strtotime($plays->created_at));
        if ($plays) {
            $finishDate = (strtotime($plays->created_at) + $period);
        }
        else{
            $finishDate = 0;
        }
        return view('faucet.index', compact('plays', 'finishDate', 'xrpRefs', 'countRefs'));
    }

    public function store(Request $request)
    {
        $user_id = Auth::user()->getAttribute('id');
        $getPlays = DB::table('plays')->where('user_id', $user_id)->latest()->first();
        $getUsers = DB::table('users')->where('id', $user_id)->latest()->first();
        //dd($getUsers);
        //Получаем курс рипла
        $url = 'https://poloniex.com/public?command=returnTicker';
        $tuCurl = curl_init();
        curl_setopt($tuCurl, CURLOPT_URL, $url);
        curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($tuCurl);
        curl_close($tuCurl);
        $xrpPrice = json_decode($result)->USDT_XRP->last;

        //Получаем курс доллара
        $url = 'https://query.yahooapis.com/v1/public/yql?q=select+*+from+yahoo.finance.xchange+where+pair+=+"USDRUB,EURRUB"&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=';
        $tuCurl = curl_init();
        curl_setopt($tuCurl, CURLOPT_URL, $url);
        curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($tuCurl);
        curl_close($tuCurl);
        $usdPrice = json_decode($result)->query->results->rate[0]->Rate;

        $period = 0.05 * 60 * 60;
        $countPay = 40/$usdPrice/$xrpPrice/7/24/60/60*$period;
        if ($getPlays) {
            if (time() - strtotime($getPlays->created_at) >= $period) {
                $statusOk = true;
            }
            else $statusOk = false;
        }
        else $statusOk = true;
        if ($statusOk) {
            $newPlay = Play::create([
                'user_id' => $user_id,
                'count' => $countPay,
                'pay' => 0,
                'type' => 'main',
            ]);
            if ($newPlay) {
                $finishDate = (time() + $period);
                if ($getUsers->user_ref_id) {
                    Play::create([
                        'user_id' => $getUsers->user_ref_id,
                        'count' => $countPay/2,
                        'pay' => 0,
                        'type' => 'ref',
                    ]);
                }
            }

        }
        else $finishDate = (strtotime($getPlays->created_at) + $period);
        return redirect('faucet');
    }
}
