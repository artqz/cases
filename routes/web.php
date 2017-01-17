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

Route::get('/', 'FaucetController@index');

Route::get('help', function () {
    return view('pages.help');
});
Route::get('contact', function () {
    return view('pages.contact');
});

Route::get('test', 'TestController@index');
Route::get('test/create', 'TestController@store');


