<?php

namespace App\Helpers;

use App\Game;
use App\Helpers\Contracts\SteamContract;
use App\Item;
use DB;
use Intervention\Image\Facades\Image;

//97E5CDC7C832E47EC6168D6F728E837E
//76561198000501285

class SteamHelper implements SteamContract
{
    /*public function getItem()
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
    }  */
    public function addItemToDB ($appid, $name, $price){
        $this->getItem($appid);
        $getGame = DB::table('all_items')->where('appid', $appid)->where('name', $name)->first();

        if ($getGame) {
            $item = Item::create([
                'appid' => $getGame->appid,
                'name' => $getGame->name,
                'price' => $price,
                'icon_url' => $getGame->icon_url,
                'icon_url_large' => $getGame->icon_url_large,
            ]);

            return $item;
        }
    }
    public function searchItemToDB ($appid, $classid, $instanceid) {
        $getGame = DB::table('all_items')->where('appid', $appid)->where('classid', $classid)->where('instanceid', $instanceid)->first();
        if ($getGame) {
            return $getGame;
        }
        else {
            return false;
        }
    }
    public function getItem ($game_id)
    {
        //$url = 'https://api.steampowered.com/ISteamEconomy/GetAssetClassInfo/v1/?key=97E5CDC7C832E47EC6168D6F728E837E&format=json&appid=570&language=ru&class_count=2&class_id=5461';
        if (strlen($game_id) == 3) $i = 2;
        else $i = 1;
        $url = 'http://steamcommunity.com/id/djoctuk/inventory/json/'.$game_id.'/'.$i;
        $tuCurl = curl_init();
        curl_setopt($tuCurl, CURLOPT_URL, $url);
        curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($tuCurl);
        curl_close($tuCurl);
        $data = json_decode($result);
        //dd($data);
        //Заносим в базу
        if ($data) {
            if ($data->success == true) {
                foreach ($data->rgDescriptions as $item) {

                    if (!$this->searchItemToDB($item->appid, $item->classid, $item->instanceid)) {

                        if (property_exists($item, 'icon_url_large')) {
                            $icon_url_large = $item->icon_url_large;
                        }
                        else $icon_url_large = 'none';

                        if (property_exists($item, 'market_hash_name')) {
                            $market_hash_name = $item->market_hash_name;
                        }
                        else $market_hash_name = 'none';

                        if (strlen($game_id) == 3) {
                            $icon_url_large_full = 'http://steamcommunity-a.akamaihd.net/economy/image/'.$icon_url_large;
                            $icon_url_full = 'http://steamcommunity-a.akamaihd.net/economy/image/'.$item->icon_url;
                        }
                        else {
                            $icon_url_large_full = 'http://community.edgecast.steamstatic.com/economy/image/'.$icon_url_large;
                            $icon_url_full = 'http://community.edgecast.steamstatic.com/economy/image/'.$item->icon_url;
                        }

                        $url = $icon_url_full;
                        $category = 'items';
                        $file_name = $item->classid;
                        $file_info = getimagesize($url);
                        $file_ext = str_replace('image/', '.', $file_info['mime'] );

                        $save = Image::make($url)->resize(null, 100, function ($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        })->save(public_path('images/'.$category.'/'.$file_name.$file_ext));

                        if ($save) {

                            DB::table('all_items')->insertGetId([
                                'appid' => $item->appid,
                                'classid' => $item->classid,
                                'instanceid' => $item->instanceid,
                                'icon_url' => url('images/'.$category.'/'.$file_name.$file_ext),
                                'icon_url_large' => $icon_url_large_full,
                                'name' => $item->name,
                                'market_hash_name' => $market_hash_name,
                                'market_name' => $item->market_name,
                                'type' => $item->type,
                                'tradable' => $item->tradable,
                                'marketable' => $item->marketable,
                            ]);
                        }

                        if (!$this->searchGameToDB ($item->appid)) {
                            $this->getGame($item->appid);
                        }
                    }
                }
            }
        }

    }
    /*
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
        $url = 'http://store.steampowered.com/api/appdetails?appids=' . $steam_id .'&language=ru';
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
            DB::table('all_games')->insertGetId([
                'type' => $data->data->type,
                'name' => $data->data->name,
                'appid' => $data->data->steam_appid,
                'required_age' => $data->data->required_age,
                'is_free' => $data->data->is_free,
                'detailed_description' => $data->data->detailed_description,
                'about_the_game' => $data->data->about_the_game,
                'short_description' => $data->data->short_description,
                'supported_languages' => $data->data->supported_languages,
                'header_image' => $data->data->header_image,
                'website' => $data->data->website,
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
    } */
    //----
    public function addGameToDB ($appid, $price, $data){
        $this->getGame($appid);
        $getGame = DB::table('all_games')->where('appid', $appid)->first();

        if ($getGame) {
            $game = Game::create([
                'appid' => $getGame->appid,
                'name' => $getGame->name,
                'price' => $price,
                'data' => $data,
                'header_image' => $getGame->header_image,
            ]);

            return $game;
        }
    }
    public function searchGameToDB ($appid) {
        $getGame = DB::table('all_games')->where('appid', $appid)->first();
        if ($getGame) {
            return $getGame;
        }
        else {
            return false;
        }
    }
    public function getGame ($game_id)
    {
        //$url = 'https://api.steampowered.com/ISteamEconomy/GetAssetClassInfo/v1/?key=97E5CDC7C832E47EC6168D6F728E837E&format=json&appid=570&language=ru&class_count=2&class_id=5461';
        $url = 'http://store.steampowered.com/api/appdetails?appids=' . $game_id .'&language=ru';
        $tuCurl = curl_init();
        curl_setopt($tuCurl, CURLOPT_URL, $url);
        curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($tuCurl);
        curl_close($tuCurl);
        $data = json_decode($result)->$game_id;
        //dd($data);
        //Заносим в базу
        if ($data) {
            if ($data->success == true) {
                if (!$this->searchGameToDB($game_id)) {

                        if ($data->data->website == null) {
                            $website = 'none';
                        }
                        else $website = $data->data->website;

                        DB::table('all_games')->insertGetId([
                        'type' => $data->data->type,
                        'name' => $data->data->name,
                        'appid' => $data->data->steam_appid,
                        'required_age' => $data->data->required_age,
                        'is_free' => $data->data->is_free,
                        'detailed_description' => $data->data->detailed_description,
                        'about_the_game' => $data->data->about_the_game,
                        'short_description' => $data->data->short_description,
                        'supported_languages' => $data->data->supported_languages,
                        'header_image' => $data->data->header_image,
                        'website' => $website,
                    ]);
                }

            }
        }

    }
}