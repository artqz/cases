<?php

namespace App\Http\Controllers;

use App\Helpers\SteamHelper;
use Illuminate\Http\Request;

class SteamController extends Controller
{
    public function getInventory(Request $request)
    {
        $steamid = \Auth::user()->steamid;
        //$steamid = $request['steamid'];
        $appid = 440;
        set_time_limit(5000);
        $url = 'http://steamcommunity.com/inventory/'.$steamid.'/'.$appid.'/2?l=russian';
        $tuCurl = curl_init();
        curl_setopt($tuCurl, CURLOPT_URL, $url);
        curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($tuCurl);
        curl_close($tuCurl);
        return $result;
    }
}