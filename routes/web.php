<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::get('/', 'PagesController@index');
//Route::get('referral/{id}/', 'PagesController@index');
Route::get('referral/{id}/', function ($id) {
    $cookie = Cookie::make('ref_id', $id, 60);
    return redirect('/')->withCookie($cookie);
});
Route::get('phpinfo', function () {
    //phpinfo();
    $url = 'http://store.steampowered.com/api/appdetails?appids=570&language=ru';
    $tuCurl = curl_init();
    curl_setopt($tuCurl, CURLOPT_URL, $url);
    curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($tuCurl);
    curl_close($tuCurl);
    $data = json_decode($result);
    dd($data);
});
Route::get('games/{id}/', 'GamesController@index');
Route::get('shop', 'ShopController@index');
Route::get('shop/items', 'ShopController@index_items');
Route::get('shop/items/update-items', 'ShopController@update_items')->middleware('auth', 'userId');
Route::get('shop/items/create-item', 'ShopController@create_item')->middleware('auth', 'userId');
Route::post('shop/items/create-item', 'ShopController@store_item')->middleware('auth', 'userId');
Route::get('shop/items/{id_post}/buy-item', 'ShopController@buy_item')->middleware('auth');
Route::get('shop/games', 'ShopController@index_games');
Route::get('shop/games/update-games', 'ShopController@update_games')->middleware('auth', 'userId');
Route::get('shop/games/create-game', 'ShopController@create_game')->middleware('auth', 'userId');
Route::post('shop/games/create-game', 'ShopController@store_game')->middleware('auth', 'userId');
Route::get('shop/games/{id_post}/buy-game', 'ShopController@buy_game')->middleware('auth');
//---
/*
Route::get('shop/game/{id}/gift/create', 'GiftsController@create')->middleware('auth', 'userId');
Route::post('shop/game/{id}/gift/create', 'GiftsController@store')->middleware('auth', 'userId');
Route::get('shop/game/create', 'GamesController@create');
Route::post('shop/game/create', 'GamesController@store');
Route::get('shop/games', 'GamesController@index');
Route::get('shop/game/{id}', 'GamesController@show');
*/
//forum
Route::get('discuss', 'DiscussController@index');
Route::get('/discuss/create-channel', 'DiscussController@create_channel')->middleware('auth', 'userId');
Route::post('/discuss/create-channel', 'DiscussController@store_channel')->middleware('auth', 'userId');
Route::get('/discuss/channels/{slug_channel}/edit-channel', 'DiscussController@edit_channel')->middleware('auth', 'userId');
Route::post('/discuss/channels/{slug_channel}/edit-channel', 'DiscussController@update_channel')->middleware('auth', 'userId');
Route::get('/discuss/channels/{slug_channel}/delete-channel', 'DiscussController@delete_channel')->middleware('auth', 'userId');
Route::get('/discuss/channels/{slug_channel}', 'DiscussController@show_channel');
Route::get('/discuss/channels/{slug_channel}/create-theme', 'DiscussController@create_theme')->middleware('auth', 'type');
Route::post('/discuss/channels/{slug_channel}/create-theme', 'DiscussController@store_theme')->middleware('auth', 'type');
Route::get('/discuss/channels/{slug_channel}/{slug_theme}/edit-theme', 'DiscussController@edit_theme')->middleware('auth', 'userId');
Route::post('/discuss/channels/{slug_channel}/{slug_theme}/edit-theme', 'DiscussController@update_theme')->middleware('auth', 'userId');
Route::get('/discuss/channels/{slug_channel}/{slug_theme}/delete-theme', 'DiscussController@delete_theme')->middleware('auth', 'userId');
Route::get('/discuss/channels/{slug_channel}/{slug_theme}', 'DiscussController@show_theme');
Route::get('/discuss/channels/{slug_channel}/{slug_theme}/create-post', 'DiscussController@create_post')->middleware('auth');
Route::post('/discuss/channels/{slug_channel}/{slug_theme}/create-post', 'DiscussController@store_post')->middleware('auth');
Route::get('/discuss/channels/{slug_channel}/{slug_theme}/{id_post}/edit-post', 'DiscussController@edit_post')->middleware('auth');
Route::post('/discuss/channels/{slug_channel}/{slug_theme}/{id_post}/edit-post', 'DiscussController@update_post')->middleware('auth');
Route::get('/discuss/channels/{slug_channel}/{slug_theme}/{id_post}/delete-post', 'DiscussController@delete_post')->middleware('auth', 'userId');
//---
Route::get('faucet', 'FaucetController@index');
Route::post('faucet/play', 'FaucetController@store')->middleware('auth');
Route::get('help', function () {
    return view('pages.help');
});
Route::get('contact', function () {
    return view('pages.contact');
});

Route::get('test', 'TestController@index');
Route::get('test/create', 'TestController@store');

//Auth
Auth::routes();


