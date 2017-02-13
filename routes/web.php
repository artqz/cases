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
Route::get('games/{id}/', 'GamesController@index');
Route::get('shop', 'ShopController@index');
Route::get('shop/game/{id}/gift/create', 'GiftsController@create');
Route::post('shop/game/{id}/gift/create', 'GiftsController@store');
Route::get('shop/game/create', 'GamesController@create');
Route::post('shop/game/create', 'GamesController@store');
Route::get('shop/games', 'GamesController@index');
Route::get('shop/game/{id}', 'GamesController@show');
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


