<?php

namespace App\Http\Controllers;

use App\Event;
use App\Helpers\SteamHelper;
use Carbon\Carbon;
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

    public function join(SteamHelper $steam)
    {
        //dd($steam->getSteamLevel(76561198126159901));
        if (!Auth::user()->steamid) {
            if ($this->steam->validate()) {
                $info = $this->steam->getUserInfo();

                if (!is_null($info)) {
                    $user = User::where('steamid', $info->steamID64)->first();
                    $user_update = User::where('id', Auth::id())->first();
                    if (is_null($user)) {
                        User::where('id', Auth::id())->update([
                            'steam_name' => $info->personaname,
                            'steam_avatar' => $info->avatarfull,
                            'steam_profile' => $info->profileurl,
                            'steamid' => $info->steamID64,
                            'steam_level' => $steam->getSteamLevel($info->steamID64),
                            'clicks' => $user_update->clicks + 10,
                            'all_clicks' => $user_update->all_clicks + 10,
                        ]);
                        //event
                        Event::create([
                            'user_id' => $user_update->id,
                            'image' => url('images/icons/steamclicks.png'),
                            'text' => 'Вы успешно подключили Steam и получили 10 кликов',
                            'url' => url('profile'),
                            'type' => 'profile',
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
        if (!Auth::user()->confirm_email) {
            $token = str_random(32);
            $user = \DB::table('confirm_emails')->where('email', Auth::user()->email)->first();

            if ($user) {
                $check = \DB::table('confirm_emails')->where('email', $user->email)->update([
                    'token' => $token,
                    'created_at' => Carbon::now(),
                ]);
                if ($check) {
                    \Mail::send('emails.confirm', array('activationUrl' => url('confirm-email/' . $token)), function ($message) {
                        $message->to(Auth::user()->email, Auth::user()->name)->subject('Подтверждение Вашей эл. почты!');
                    });
                    return redirect('profile')->with([
                        'flash_message' => 'На Вашу эл. почту повторно отправлено письмо с подтверждением!',
                        'flash_message_status' => 'success',
                    ]);
                }
            } else {
                $check = \DB::table('confirm_emails')->insert([
                    'email' => Auth::user()->email,
                    'token' => $token,
                    'created_at' => Carbon::now(),
                ]);
                if ($check) {
                    \Mail::send('emails.confirm', array('activationUrl' => url('confirm-email/' . $token)), function ($message) {
                        $message->to(Auth::user()->email, Auth::user()->name)->subject('Подтверждение Вашей эл. почты!');
                    });
                    return redirect('profile')->with([
                        'flash_message' => 'На Вашу эл. почту отправлено письмо с подтверждением!',
                        'flash_message_status' => 'success',
                    ]);
                }
            }
        }
        return redirect('profile')->with([
            'flash_message' => 'Ваша эл. почту уже подтверждена!',
            'flash_message_status' => 'danger',
        ]);
    }

    public function confirm_email($token_email)
    {
        $user = \DB::table('confirm_emails')->where('token', $token_email)->first();
        $user_update = User::where('id', Auth::id())
            ->where('confirm_email', 0)
            ->first();

        if ($user) {
            User::where('email', $user->email)->update([
                'confirm_email' => 1,
                'clicks' => $user_update->clicks + 10,
                'all_clicks' => $user_update->all_clicks + 10,
            ]);
            //event
            Event::create([
                'user_id' => $user_update->id,
                'image' => url('images/icons/steamclicks.png'),
                'text' => 'Вы успешно подтвердили эл. почту и получили 10 кликов',
                'url' => url('profile'),
                'type' => 'profile',
            ]);
            return redirect('profile')->with([
                'flash_message' => 'Ваша эл. почта подтверждена!',
                'flash_message_status' => 'success',
            ]);
        }
        return redirect('/');
    }

}
