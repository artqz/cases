<?php

namespace App\Http\Controllers;

use Invisnik\LaravelSteamAuth\SteamAuth;
use App\User;
use Auth;

class AuthController extends Controller
{
    /**
     * @var SteamAuth
     */
    private $steam;

    public function __construct(SteamAuth $steam)
    {
        $this->steam = $steam;
    }

    public function login()
    {
        if(Auth::id())
        {
            if ($this->steam->validate()) {
                $info = $this->steam->getUserInfo();
                if (!is_null($info)) {
                        $user = User::where('id', Auth::id())->update([
                            'steam_name' => $info->personaname,
                            'steam_avatar'   => $info->avatarfull,
                            'steam_steamid'  => $info->steamID64
                        ]);
                    
                    Auth::login($user, true);
                    return redirect('/'); // redirect to site
                }
            }
        }
        else {
          dd('her');
        }
        return $this->steam->redirect(); // redirect to Steam login page
    }
}
