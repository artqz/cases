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
    /*
    public function login()
    {
        if ($this->steam->validate()) {
            $info = $this->steam->getUserInfo();

            if (!is_null($info)) {
                $user = User::where('steamid', $info->steamID64)->first();
                if (is_null($user)) {
                    $user = User::create([
                        'steam_name' => $info->personaname,
                        'steam_avatar'   => $info->avatarfull,
                        'steamid'  => $info->steamID64
                    ]);
                }
                Auth::login($user, true);
                return redirect('/'); // redirect to site
            }
        }
        return $this->steam->redirect(); // redirect to Steam login page
    }
    */

    public function join()
    {
        if (!Auth::user()->steamid) {
            if ($this->steam->validate()) {
                $info = $this->steam->getUserInfo();

                if (!is_null($info)) {
                    $user = User::where('steamid', $info->steamID64)->first();
                    if (is_null($user)) {
                        User::where('id', Auth::id())->update([
                            'steam_name' => $info->personaname,
                            'steam_avatar' => $info->avatarfull,
                            'steam_profile' => $info->profileurl,
                            'steamid' => $info->steamID64
                        ]);
                        return redirect('profile')->with([
                            'flash_message' => 'Вы успешно подключили аккаунт Steam',
                            'flash_message_status' => 'success',
                        ]);
                    } else {
                        return redirect('profile')->with([
                            'flash_message' => 'Этот аккаунт Steam уже подключен!',
                            'flash_message_status' => 'danger',
                        ]);
                    }
                }
                return redirect('profile'); // redirect to site

            }
            return $this->steam->redirect(); // redirect to Steam login page
        }
        return redirect('profile')->with([
            'flash_message' => 'У Вас уже подключен Steam аккаунт!',
            'flash_message_status' => 'danger',
        ]);
    }

    public function check_email()
    {
        $token=str_random(32); //это наша случайная строка
        \DB::table('confirm_emails')->insert([
            'user_id' => Auth::id(),
            'email' => Auth::user()->email,
            'token' => $token,
        ]);

    }

}
