<?php

namespace App\Helpers;

use App\Game;
use App\Helpers\Contracts\SteamContract;
use App\Item;
use DB;
use Intervention\Image\Facades\Image;

//97E5CDC7C832E47EC6168D6F728E837E
//76561198000501285
//http://steamcommunity.com/inventory/76561198000501285/570/2?l=english
// level steam http://api.steampowered.com/IPlayerService/GetSteamLevel/v1/?key=97E5CDC7C832E47EC6168D6F728E837E&steamid=76561198081479010
//http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=97E5CDC7C832E47EC6168D6F728E837E&steamids=76561197960435530

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
    public function getSteamLevel ($steamid) {
        $url = 'http://api.steampowered.com/IPlayerService/GetSteamLevel/v1/?key=97E5CDC7C832E47EC6168D6F728E837E&steamid='.$steamid;
        $tuCurl = curl_init();
        curl_setopt($tuCurl, CURLOPT_URL, $url);
        curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($tuCurl);
        curl_close($tuCurl);
        $data = json_decode($result);
        return $data->response->player_level;
    }

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
                'type' => $getGame->type,
                'name_color' => $getGame->name_color,
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
        $url = 'http://steamcommunity.com/id/steamclicks/inventory/json/'.$game_id.'/'.$i;
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

                        if (file_exists(public_path('images/'.$category.'/'.$file_name.$file_ext))) {
                            $save = true;
                        }
                        else {
                            $save = Image::make($url)->resize(null, 100, function ($constraint) {
                                $constraint->aspectRatio();
                                $constraint->upsize();
                            })->save(public_path('images/'.$category.'/'.$file_name.$file_ext));
                        }

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
                                'name_color' => $item->name_color,
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

    public function addDistributionToDB ($id, $type){
        if ($type == 1) {
            $this->getPackage($id);
            $getPackage = DB::table('all_packages')->where('subid', $id)->first();

            if ($getPackage) {
                return $getPackage;
            } else return false;
        }
        if ($type == 2) {
            $this->getGame($id);
            $getGame = DB::table('all_games')->where('appid', $id)->first();

            if ($getGame) {
                return $getGame;
            } else return false;
        }
    }
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

                        $url = $data->data->header_image;
                        $category = 'games';
                        $file_name = $data->data->steam_appid;
                        $file_info = getimagesize($url);
                        $file_ext = str_replace('image/', '.', $file_info['mime'] );

                        if (file_exists(public_path('images/'.$category.'/'.$file_name.$file_ext))) {
                            $save = true;
                        }
                        else {
                            $save = Image::make($url)->resize(null, 100, function ($constraint) {
                                $constraint->aspectRatio();
                                $constraint->upsize();
                            })->save(public_path('images/'.$category.'/'.$file_name.$file_ext));
                        }


                        if ($save) {
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
                                'header_image' => url('images/'.$category.'/'.$file_name.$file_ext),
                                'website' => $website,
                            ]);
                        }

                }

            }
        }

    }

    public function searchPackageToDB ($subid) {
        $getPackage = DB::table('all_packages')->where('subid', $subid)->first();
        if ($getPackage) {
            return $getPackage;
        }
        else {
            return false;
        }
    }

    public function getPackage ($package_id)
    {
        //$url = 'https://api.steampowered.com/ISteamEconomy/GetAssetClassInfo/v1/?key=97E5CDC7C832E47EC6168D6F728E837E&format=json&appid=570&language=ru&class_count=2&class_id=5461';
        //$url = 'http://store.steampowered.com/api/appdetails?appids=' . $game_id .'&language=ru';
        $url = 'http://store.steampowered.com/api/packagedetails?packageids='.$package_id.'&cc=ru';
        $tuCurl = curl_init();
        curl_setopt($tuCurl, CURLOPT_URL, $url);
        curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($tuCurl);
        curl_close($tuCurl);
        $data = json_decode($result)->$package_id;
        //dd($data);
        //Заносим в базу
        if ($data) {
            if ($data->success == true) {
                if (!$this->searchPackageToDB($package_id)) {

                    $url = $data->data->header_image;
                    $category = 'packages';
                    $file_name = $package_id;
                    $file_info = getimagesize($url);
                    $file_ext = str_replace('image/', '.', $file_info['mime'] );

                    if (file_exists(public_path('images/'.$category.'/'.$file_name.$file_ext))) {
                        $save = true;
                    }
                    else {
                        $save = Image::make($url)->resize(null, 100, function ($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        })->save(public_path('images/'.$category.'/'.$file_name.$file_ext));
                    }


                    if ($save) {
                        DB::table('all_packages')->insertGetId([
                            'name' => $data->data->name,
                            'subid' => $package_id,
                            'page_content' => $data->data->page_content,
                            'header_image' => url('images/'.$category.'/'.$file_name.$file_ext),
                        ]);
                    }

                }

            }
        }

    }
}