<?php

namespace App\Helpers;

use App\Helpers\Contracts\SteamContract;
use DB;

class SteamHelper implements SteamContract
{
    public function getGame($steam_id)
    {
        //Проверяем есть ли игра в базе
        if ($this->searchGameToDB($steam_id)) {
            $data = $this->searchGameToDB($steam_id);
            return $data;
        }
        //Если игры нет - добавляем в базу
        else {
            if ($idGame = $this->addGameToDB($steam_id)) {
                $data = $this->getGameToDB($idGame);
                return $data;
            }
        }
    }

    public function searchGameToDB ($steam_id) {
        $getGame = DB::table('games')->where('steam_id', $steam_id)->first();
        if ($getGame) {
            return $getGame;
        }
        else {
            return false;
        }
    }

    public function addGameToDB ($steam_id) {
        //Получаем информацию по игре
        $url = 'http://store.steampowered.com/api/appdetails?appids=' . $steam_id;
        $tuCurl = curl_init();
        curl_setopt($tuCurl, CURLOPT_URL, $url);
        curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($tuCurl);
        curl_close($tuCurl);
        $data = json_decode($result)->$steam_id;
        //Заносим в базу
        if ($data->data->is_free == false) {
            $idGame = DB::table('games')->insertGetId([
                'steam_id' => $data->data->steam_appid,
                'name' => $data->data->name,
                'header_image' => $data->data->header_image,
                'price_rub' => substr($data->data->price_overview->initial, 0, -2),
                'price_click' => substr($data->data->price_overview->initial, 0, -2)/config('main.price_click'),
            ]);
            if ($idGame) {
                return $idGame;
            } else {
                return false;
            }
        }
        else return false;
    }

    public function getGameToDB ($game_id) {
        $getGame = DB::table('games')->where('id', $game_id)->first();
        if ($getGame) {
            return $getGame;
        }
        else {
            return false;
        }
    }
}