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
Route::get('referral', 'PagesController@index_referral');
Route::get('r/{id}/', function ($id) {
    $cookie = Cookie::make('ref_id', $id, 60);
    return redirect('/')->withCookie($cookie);
});
Route::get('redis', function () {
    $redis = app()->make('redis');
    $redis->set('key1', 'testVal');

    return $redis->get('key1');
});

Route::get('cache', function () {
    $value = Cache::get('key', function () {
        return DB::table('items')->get();
    });
    return $value;
});

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
Route::get('faucet', 'FaucetController@index')->middleware('auth');
Route::post('faucet/get-click', 'FaucetController@get_click')->middleware('auth');
Route::get('profile', 'PagesController@index_profile')->middleware('auth');
Route::get('my-games', 'PagesController@index_my_games')->middleware('auth');
Route::get('my-items', 'PagesController@index_my_items')->middleware('auth');

Route::get('test', 'TestController@index');
Route::get('test/create', 'TestController@store');

//Auth
Auth::routes();


