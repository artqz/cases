<?php

namespace App\Http\Controllers;

use App\Helpers\SteamHelper;
use Illuminate\Http\Request;

class SteamController extends Controller
{
    public function getInventory(Request $request)
    {
        $steamid = $request['steamid'];
        $appid = $request['appid'];
        $contextid = $request['contextid'];
        set_time_limit(5000);
        $url = 'http://steamcommunity.com/inventory/'.$steamid.'/'.$appid.'/'.$contextid.'?l=russian';
        $tuCurl = curl_init();
        curl_setopt($tuCurl, CURLOPT_URL, $url);
        curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($tuCurl);
        curl_close($tuCurl);
        return $result;
    }
}
