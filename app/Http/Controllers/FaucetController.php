<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaucetController extends Controller
{
    public function index ()
    {

        return view('faucet.index');

    }
}
