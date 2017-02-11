<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Cookie;
use Response;


class ReferralController extends Controller
{
    public function index ($id)
    {
        //return $request->make('hello $nane')->withCookie($cookie);
        return redirect()->action('FaucetController@index');
    }
}
