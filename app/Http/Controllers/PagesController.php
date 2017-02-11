<?php

namespace App\Http\Controllers;

use App\User;
use App\Play;
use Illuminate\Http\Request;
use Cookie;

class PagesController extends Controller
{
    public function index ()
    {

        $users = User::count();
        $plays = Play::count();
        if (Cookie::get('ref_id')) {
            $ref = Cookie::get('ref_id');
        }
        else $ref = 0;

        return view('pages.start', compact('users', 'plays', 'ref'));

    }
}
