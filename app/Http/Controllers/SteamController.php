<?php

namespace App\Http\Controllers;

use App\Helpers\SteamHelper;
use Illuminate\Http\Request;

class SteamController extends Controller
{
    public function getAllGames(SteamHelper $steam)
    {
        return $steam->getAllGames();
    }
}
